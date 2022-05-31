<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($_SERVER['HTTP_REFERER'])) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die(header("Location: http://dkpm.com/jt3MJLZirM.html"));
}

error_reporting(0);
ini_set('display_errors', 0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

date_default_timezone_set('Asia/Hong_Kong');


//$hcaptcha = $data->user_token;

//$hcaptcha_json = file_get_contents('https://hcaptcha.com/siteverify?secret=0x5606ccBCe6844DB91900Ab9c85046cdC87277239&response='.$hcaptcha);
//$hcaptcha_status = json_decode($hcaptcha_json);

//if ($hcaptcha_status->success) {
    $dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
    $validation_array = array();
    if ($dkpm_conn->connect_errno) {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "disconneted");
        echo json_encode($validation_array);

        die();
    } else {

        require_once './yiycotD377gwN7cxpCuA.php';

        $json = file_get_contents("php://input");
        $data = json_decode($json);

        // login verification

        $now = date("Y-m-d H:i:s");
        $minutes_ago = date("Y-m-d H:i:s", strtotime('-15 minutes'));
        $user_email = $data->user_email;
        $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
        $login_log_key = "zjRWi0fNgiCpdHXzeCet0RoxeEZhrkJ6IQ8CGAHXhfnIkqDft3jPbTprFRsyrEAQQF9Cs8Xd0scjAKbg01p3OSXcnlYfeITwnXXs";

        $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
        $stmt_check_account->bind_param("s", $user_email);
        $stmt_check_account->execute();
        $stmt_check_account->bind_result($user_id);
        $stmt_check_account->store_result();
        $stmt_check_account->fetch();

        if ($stmt_check_account->num_rows) {
            $stmt_checkActivation = $dkpm_conn->prepare("SELECT VALID_STATUS FROM dkpm.user_account WHERE AES_DECRYPT(USER_ID, '".$key."') = ?");
            $stmt_checkActivation->bind_param("s", $user_id);
            $stmt_checkActivation->execute();
            $stmt_checkActivation->bind_result($valid_status);
            $stmt_checkActivation->store_result();
            $stmt_checkActivation->fetch();

            if ($valid_status == 1) {
                $stmt_countLog = $dkpm_conn->prepare("SELECT COUNT(LOGIN_STATUS) as `COUNT` FROM dkpm.user_login_log WHERE AES_DECRYPT(USER_ID, '".$login_log_key."') = ? AND LOGIN_TIME BETWEEN ? AND ?");
                $stmt_countLog->bind_param("sss", $user_id, $now, $minutes_ago);
                $stmt_countLog->execute();
                $stmt_countLog->bind_result($count);
                $stmt_countLog->store_result();
                $stmt_countLog->fetch();

                if ($count < 5) { 
                    $stmt_password = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_PASSWORD, '".$key."'), AES_DECRYPT(REGISTER_TIME, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
                    $stmt_password->bind_param("s", $user_email);
                    $stmt_password->execute();
                    $stmt_password->bind_result($user_password, $register_time);
                    $stmt_password->store_result();
                    $stmt_password->fetch();

                    //$password = $data->user_password;
                    //$decrypted_pw = secondEn::decrypt($user_password, $register_time);
                    $password = hash('sha512', $register_time.$data->user_password);
                                            
                    if ($password === $user_password) {
                        $token = bin2hex(random_bytes(16));
                        $encrypted_token = secondEn::encrypt($token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
                        $access_token = bin2hex($encrypted_token);

                        $stmt_addTimes = $dkpm_conn->prepare("UPDATE dkpm.user_account SET LOGIN_TIMES = LOGIN_TIMES + 1, ONE_TIME_TOKEN = AES_ENCRYPT(?, '".$key."') WHERE AES_DECRYPT(USER_ID, '".$key."') = ?");
                        $stmt_addTimes->bind_param("ss", $token, $user_id);
                        $stmt_addTimes->execute();
                        $status = 1;

                        http_response_code(200);
                        $validation_array = array("error" => false, "mwju720mpz" => $access_token);
                        echo json_encode($validation_array);
                    } else {
                        $status = 0;

                        http_response_code(401);
                        $validation_array = array("error" => true, "message" => "wrong_password");
                        echo json_encode($validation_array);
                    }

                    $stmt_addLog = $dkpm_conn->prepare("INSERT INTO dkpm.user_login_log (USER_ID, LOGIN_STATUS, LOGIN_TIME) VALUES (AES_ENCRYPT(?, '".$login_log_key."'), ?, ?)");
                    $stmt_addLog->bind_param("sis", $user_id, $status, $now);
                    $stmt_addLog->execute();
                    $stmt_addLog->close();

                    $stmt_password->close();
                } else {
                    http_response_code(401);
                    $validation_array = array("error" => true, "message" => "wrong_many_times");
                    echo json_encode($validation_array);
                }
            } else {
                http_response_code(401);
                $validation_array = array("error" => true, "message" => "inactivated_account");
                echo json_encode($validation_array);
            }
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "invalid_account");
            echo json_encode($validation_array);
        }

        $stmt_check_account->close();

        mysqli_close($dkpm_conn);

        die();
    }

//} else {
//    http_response_code(401);
//    $validation_array = array("error" => true, "message" => "timeout");
//    echo json_encode($validation_array);
//}

?>