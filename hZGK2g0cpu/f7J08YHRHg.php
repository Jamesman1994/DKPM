<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($_SERVER['HTTP_REFERER'])) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die(header("Location: https://dkpm.com/jt3MJLZirM.html"));
}

error_reporting(0);
ini_set('display_errors', 0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

date_default_timezone_set('Asia/Hong_Kong');

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
$validation_array = array();
$password_array = array();

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);

    die();
} else {
    // clear history

    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $access_token = hex2bin($data->bY5aODOvba);
    $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
    $history_key = "DRBcNakY1EHs2liEuRu5ZFB1eQx1XNGHUA6cjk3OxIZn2HJLpXuoTCOVkvHPJEGT2uJJQDIEvRGUA2FjHrJ5DIBdbtBGLahgT13q";

    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
    $stmt_check_account->bind_param("s", $decrypted_token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();
    
    if ($stmt_check_account->num_rows) {
        $stmt_delete_history = $dkpm_conn->prepare("DELETE FROM dkpm.password_history WHERE AES_DECRYPT(USER_ID, '".$history_key."') = ?");
        $stmt_delete_history->bind_param("s", $user_id);
        $stmt_delete_history->execute();
        $stmt_delete_history->close();

        http_response_code(200);
        $validation_array = array("error" => false);
        echo json_encode($validation_array);
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => true);
        echo json_encode($validation_array);
    }

    mysqli_close($dkpm_conn);

    die();
}


?>