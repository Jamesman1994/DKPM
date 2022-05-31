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

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
$validation_array = array();

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);
    die();
} else {
    // check password

    require_once './yiycotD377gwN7cxpCuA.php';
        
    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $password = $data->password;
    $strength = $data->strength;

    $access_token = hex2bin($data->qel7c1mdcj);
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

        $stmt_get_register_time = $dkpm_conn->prepare("SELECT AES_DECRYPT(REGISTER_TIME, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_ID, '".$key."') = ?");
        $stmt_get_register_time->bind_param("s", $user_id);
        $stmt_get_register_time->execute();
        $stmt_get_register_time->bind_result($register_time);
        $stmt_get_register_time->store_result();
        $stmt_get_register_time->fetch();
        $stmt_get_register_time->close();

        $encrypted_pw = hash('sha512', $register_time.$password);

        $stmt_check_password = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_account WHERE AES_DECRYPT(USER_ID, '".$key."') = ? AND AES_DECRYPT(USER_PASSWORD, '".$key."') = ?");
        $stmt_check_password->bind_param("ss", $user_id, $encrypted_pw);
        $stmt_check_password->execute();
        $stmt_check_password->bind_result($count_1);
        $stmt_check_password->store_result();
        $stmt_check_password->fetch();
    
        $stmt_check_vault_password = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_account_vault WHERE AES_DECRYPT(USER_ID, '".$vault_key."') = ? AND AES_DECRYPT(PASSWORD, '".$vault_key."') = ?");
        $stmt_check_vault_password->bind_param("ss", $user_id, $password);
        $stmt_check_vault_password->execute();
        $stmt_check_vault_password->bind_result($count_2);
        $stmt_check_vault_password->store_result();
        $stmt_check_vault_password->fetch();
    
        if ($count_1 > 0 || $count_2 > 0) {
            http_response_code(401);
            $validation_array = array("error" => false, "duplicate" => true);
            echo json_encode($validation_array);
        } else {
            http_response_code(200);
            $validation_array = array("error" => false, "duplicate" => false, "strength" => $strength);
            echo json_encode($validation_array);
        }
    
        $stmt_check_password->close();
        $stmt_check_vault_password->close();
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "fail");
        echo json_encode($validation_array);
    }

    mysqli_close($dkpm_conn);

    die();
}



?>