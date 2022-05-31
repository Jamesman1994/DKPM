<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: https://dkpm.com/jt3MJLZirM.html");
    die();
}

error_reporting(0);
ini_set('display_errors', 0);

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
    // delete item
    
    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $access_token = hex2bin($data->ups57l2gzz);
    $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $vault_key = "LnKkHahknEELy4Ll7wuR1SzJPAnMB5faZ7Vy3cRKWD75Su44GbP0OqQQ3A5vJsYmvwrYmyGhHiFTDXvGyeb7pdBW6Me25PUSRNHn";
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
    
    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
    $stmt_check_account->bind_param("s", $decrypted_token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();

    if ($stmt_check_account->num_rows) {
        $stmt_delete = $dkpm_conn->prepare("DELETE FROM dkpm.user_account_vault WHERE AES_DECRYPT(USER_ID, '".$vault_key."') = ? AND AES_DECRYPT(RECORD_ID, '".$vault_key."') = ?");
        $stmt_delete->bind_param("ss", $user_id, $data->bjj7hlgora);
        
        if ($stmt_delete->execute()) {
            http_response_code(200);
            $validation_array = array("error" => false);
            echo json_encode($validation_array);
            die();
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "system_error");
            echo json_encode($validation_array);
            die();
        }
    
        $stmt_delete->close();
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "fail");
        echo json_encode($validation_array);
        die();
    }
}

mysqli_close($dkpm_conn);

?>