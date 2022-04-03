<?php

class firstEn
{
    const METHOD = 'aes-256-ctr';

    public static function encrypt($message, $key, $encode = false)
    {
        $nonceSize = openssl_cipher_iv_length(self::METHOD);
        $nonce = openssl_random_pseudo_bytes($nonceSize);

        $ciphertext = openssl_encrypt(
            $message,
            self::METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        if ($encode) {
            return base64_encode($nonce.$ciphertext);
        }
        return $nonce.$ciphertext;
    }

    public static function decrypt($message, $key, $encoded = false)
    {
        if ($encoded) {
            $message = base64_decode($message, true);
            if ($message === false) {
                throw new Exception('Wrong');
            }
        }

        $nonceSize = openssl_cipher_iv_length(self::METHOD);
        $nonce = mb_substr($message, 0, $nonceSize, '8bit');
        $ciphertext = mb_substr($message, $nonceSize, null, '8bit');

        $plaintext = openssl_decrypt(
            $ciphertext,
            self::METHOD,
            $key,
            OPENSSL_RAW_DATA,
            $nonce
        );

        return $plaintext;
    }
}

class secondEn extends firstEn
{
    const HASH_ALGO = 'sha256';

    public static function encrypt($message, $key, $encode = false)
    {
        list($encKey, $authKey) = self::splitKeys($key);

        $ciphertext = parent::encrypt($message, $encKey);

        $mac = hash_hmac(self::HASH_ALGO, $ciphertext, $authKey, true);

        if ($encode) {
            return base64_encode($mac.$ciphertext);
        }
        return $mac.$ciphertext;
    }

    public static function decrypt($message, $key, $encoded = false)
    {
        list($encKey, $authKey) = self::splitKeys($key);
        if ($encoded) {
            $message = base64_decode($message, true);
            if ($message === false) {
                throw new Exception('Wrong');
            }
        }

        $hs = mb_strlen(hash(self::HASH_ALGO, '', true), '8bit');
        $mac = mb_substr($message, 0, $hs, '8bit');

        $ciphertext = mb_substr($message, $hs, null, '8bit');

        $calculated = hash_hmac(
            self::HASH_ALGO,
            $ciphertext,
            $authKey,
            true
        );

        if (!self::hashEquals($mac, $calculated)) {
            throw new Exception('Wrong');
        }

        $plaintext = parent::decrypt($ciphertext, $encKey);

        return $plaintext;
    }

    protected static function splitKeys($masterKey)
    {
        return [
            hash_hmac(self::HASH_ALGO, 'ENCRYPTION', $masterKey, true),
            hash_hmac(self::HASH_ALGO, 'AUTHENTICATION', $masterKey, true)
        ];
    }

    protected static function hashEquals($a, $b)
    {
        if (function_exists('hash_equals')) {
            return hash_equals($a, $b);
        }
        $nonce = openssl_random_pseudo_bytes(32);
        return hash_hmac(self::HASH_ALGO, $a, $nonce) === hash_hmac(self::HASH_ALGO, $b, $nonce);
    }
}

?>