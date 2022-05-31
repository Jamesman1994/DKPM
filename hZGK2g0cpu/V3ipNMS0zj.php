<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($_SERVER['HTTP_REFERER'])) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die(header("Location: http://dkpm.com/jt3MJLZirM.html"));
}

error_reporting(0);
ini_set('display_errors', 0);

date_default_timezone_set('Asia/Hong_Kong');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
$validation_array = array();

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);

    die();
} else {
    // check token
    
    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $access_token = hex2bin($data->ew8zd3j6yi);
    $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
    $stmt_check_account->bind_param("s", $decrypted_token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();

    if ($stmt_check_account->num_rows) {
        $login_log_key = "zjRWi0fNgiCpdHXzeCet0RoxeEZhrkJ6IQ8CGAHXhfnIkqDft3jPbTprFRsyrEAQQF9Cs8Xd0scjAKbg01p3OSXcnlYfeITwnXXs";

        $stmt_check_lock_time = $dkpm_conn->prepare("SELECT AES_DECRYPT(LOCK_TIME, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_ID, '".$key."') = ?");
        $stmt_check_lock_time->bind_param("s", $user_id);
        $stmt_check_lock_time->execute();
        $stmt_check_lock_time->bind_result($lock_time);
        $stmt_check_lock_time->store_result();
        $stmt_check_lock_time->fetch();
        $stmt_check_lock_time->close();

        $stmt_last_login_time = $dkpm_conn->prepare("SELECT LOGIN_TIME FROM dkpm.user_login_log WHERE AES_DECRYPT(USER_ID, '".$login_log_key."') = ? AND LOGIN_STATUS = 1 ORDER BY LOGIN_TIME DESC LIMIT 1");
        $stmt_last_login_time->bind_param("s", $user_id);
        $stmt_last_login_time->execute();
        $stmt_last_login_time->bind_result($last_login_time);
        $stmt_last_login_time->store_result();
        $stmt_last_login_time->fetch();
        $stmt_last_login_time->close();

        if ($lock_time == 0 || (strtotime(date('Y-m-d H:i:s')) - strtotime($last_login_time)) < $lock_time) {
            http_response_code(200);
            $validation_array = array("error" => false, "message" => "success");
            echo json_encode($validation_array);
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "fail");
            echo json_encode($validation_array);
        }
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "fail");
        echo json_encode($validation_array);
    }

    $stmt_check_account->close();

    mysqli_close($dkpm_conn);

    die();
}

?>