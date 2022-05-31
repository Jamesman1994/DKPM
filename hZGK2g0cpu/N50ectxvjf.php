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

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);

    die();
} else {
    // add item

    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    if (filter_var($data->url, FILTER_VALIDATE_URL) === FALSE && filter_var($data->domain, FILTER_VALIDATE_URL) === FALSE) {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "wrong_domain");
        echo json_encode($validation_array);
    } else {
        $access_token = hex2bin($data->in386iWR1e);
        $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
        $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

        $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
        $stmt_check_account->bind_param("s", $decrypted_token);
        $stmt_check_account->execute();
        $stmt_check_account->bind_result($user_id);
        $stmt_check_account->store_result();
        $stmt_check_account->fetch();

        if ($stmt_check_account->num_rows) {
            $vault_key = "LnKkHahknEELy4Ll7wuR1SzJPAnMB5faZ7Vy3cRKWD75Su44GbP0OqQQ3A5vJsYmvwrYmyGhHiFTDXvGyeb7pdBW6Me25PUSRNHn";

            $stmt_check_vault = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_account_vault WHERE AES_DECRYPT(USER_ID, '".$vault_key."') = ? AND AES_DECRYPT(USER_NAME, '".$vault_key."') = ? AND AES_DECRYPT(URL, '".$vault_key."') = ?");
            $stmt_check_vault->bind_param("sss", $user_id, $data->user_name, $data->url);
            $stmt_check_vault->execute();
            $stmt_check_vault->bind_result($count);
            $stmt_check_vault->store_result();
            $stmt_check_vault->fetch();
        
            if ($count > 0) {
                http_response_code(401);
                $validation_array = array("error" => true, "message" => "duplicate");
                echo json_encode($validation_array);
            } else {
                $now = date('Y-m-d H:i:s');

                $stmt_get_password = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_PASSWORD, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
                $stmt_get_password->bind_param("s", $decrypted_token);
                $stmt_get_password->execute();
                $stmt_get_password->bind_result($user_password);
                $stmt_get_password->store_result();
                $stmt_get_password->fetch();
    
                $encrypted_pw = secondEn::encrypt($data->user_password, $user_password);
                
                $stmt_get_password->close();
    
                $stmt_insert_account = $dkpm_conn->prepare("INSERT INTO dkpm.user_account_vault (RECORD_ID, USER_ID, ITEM_NAME, ITEM_ICON, USER_NAME, PASSWORD, DOMAIN, URL, REMARKS, RECORD_TIME) VALUES (AES_ENCRYPT(UUID(), '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), AES_ENCRYPT(?, '".$vault_key."'), ?)");
                $stmt_insert_account->bind_param("sssssssss", $user_id, $data->item_name, $data->item_icon, $data->user_name, $encrypted_pw, $data->domain, $data->url, $data->remarks, $now);
                
                if ($stmt_insert_account->execute()) {
                    http_response_code(200);
                    $validation_array = array("error" => false, "message" => $data->remarks);
                    echo json_encode($validation_array);
                } else {
                    http_response_code(401);
                    $validation_array = array("error" => true, "message" => "fail");
                    echo json_encode($validation_array);
                }
    
                $stmt_insert_account->close();
            }
        
            $stmt_check_vault->close();
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "fail");
            echo json_encode($validation_array);
        } 

        $stmt_check_account->close();

        mysqli_close($dkpm_conn);

        die();
    }
}

?>