<?php

error_reporting(0);
ini_set('display_errors', 0);

class firstEn {
    const METHOD = 'aes-256-ctr';

    public static function encrypt($message, $key, $encode = false) {
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

    public static function decrypt($message, $key, $encoded = false) {
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

class secondEn extends firstEn {
    const HASH_ALGO = 'sha256';

    public static function encrypt($message, $key, $encode = false) {
        list($encKey, $authKey) = self::splitKeys($key);

        $ciphertext = parent::encrypt($message, $encKey);

        $mac = hash_hmac(self::HASH_ALGO, $ciphertext, $authKey, true);

        if ($encode) {
            return base64_encode($mac.$ciphertext);
        }
        return $mac.$ciphertext;
    }

    public static function decrypt($message, $key, $encoded = false) {
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

    protected static function splitKeys($masterKey) {
        return [
            hash_hmac(self::HASH_ALGO, 'ENCRYPTION', $masterKey, true),
            hash_hmac(self::HASH_ALGO, 'AUTHENTICATION', $masterKey, true)
        ];
    }

    protected static function hashEquals($a, $b) {
        if (function_exists('hash_equals')) {
            return hash_equals($a, $b);
        }
        $nonce = openssl_random_pseudo_bytes(32);
        return hash_hmac(self::HASH_ALGO, $a, $nonce) === hash_hmac(self::HASH_ALGO, $b, $nonce);
    }
}

class actionEn {
    public static function check($action, $input) {
        $first_key = "hptnDbQ3KMeztkEQ5Z4E";
        $second_key = "zLZ0eGuvZ9CFSP1fQbAt";   
        $mix = base64_decode($input);
        $iv_length = openssl_cipher_iv_length("aes-256-cbc");
        $iv = substr($mix, 0, $iv_length);
        //$second_encrypted = substr($mix, $iv_length, 64);
        $first_encrypted = substr($mix, $iv_length + 64);
                
        $output = openssl_decrypt($first_encrypted, "aes-256-cbc", $first_key, OPENSSL_RAW_DATA, $iv);
        //$second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        
        if ($action == $output) {
            return true;
        } else {
            return false;
        }

        //if (hash_equals($second_encrypted,$second_encrypted_new))
        //$output = base64_encode($iv.$second_encrypted.$first_encrypted);   
        //$output = "xKiOei6522KV3fRjIVLYayLoPJmhPKQvJnjPQPK43MxnrTYSiqktkPgyI8WIdrLy2qCKu8qSOLxjw5IYYRwbmUZIVN43MbqKf7b6QDza4tBFr5ht1Eppf5/12iHVlh1K";
    }

    public static function create($input) {
        $first_key = "hptnDbQ3KMeztkEQ5Z4E";
        $second_key = "zLZ0eGuvZ9CFSP1fQbAt";   
        $method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
            
        $first_encrypted = openssl_encrypt($input, $method, $first_key, OPENSSL_RAW_DATA , $iv);   
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        $output = base64_encode($iv.$second_encrypted.$first_encrypted);

        return $output;
    }

    public static function reverse($input) {
        $first_key = "hptnDbQ3KMeztkEQ5Z4E";
        $second_key = "zLZ0eGuvZ9CFSP1fQbAt";   
        $mix = base64_decode($input);
        $iv_length = openssl_cipher_iv_length("aes-256-cbc");
        $iv = substr($mix, 0, $iv_length);
        //$second_encrypted = substr($mix, $iv_length, 64);
        $first_encrypted = substr($mix, $iv_length + 64);
                
        $output = openssl_decrypt($first_encrypted, "aes-256-cbc", $first_key, OPENSSL_RAW_DATA, $iv);
        echo $output;

        return $output;
    }
    
}

?>