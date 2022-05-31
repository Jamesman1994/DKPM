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

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);

    die();
} else {
    // autofill item

    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);
    
    $access_token = hex2bin($data->g1UnjT7o7t);
    $record_id = hex2bin($data->sNnv2Orbeq);
    $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
    $vault_key = "LnKkHahknEELy4Ll7wuR1SzJPAnMB5faZ7Vy3cRKWD75Su44GbP0OqQQ3A5vJsYmvwrYmyGhHiFTDXvGyeb7pdBW6Me25PUSRNHn";

    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
    $stmt_check_account->bind_param("s",  $decrypted_token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();

    if ($stmt_check_account->num_rows) {
        $stmt_detail = $dkpm_conn->prepare("SELECT AES_DECRYPT(uav.USER_NAME, '".$vault_key."'), AES_DECRYPT(uav.PASSWORD, '".$vault_key."'), AES_DECRYPT(uav.URL, '".$vault_key."'), AES_DECRYPT(ua.USER_PASSWORD, '".$key."') FROM dkpm.user_account_vault uav LEFT JOIN dkpm.user_account ua on AES_DECRYPT(uav.USER_ID, '".$vault_key."') = AES_DECRYPT(ua.USER_ID, '".$key."') WHERE AES_DECRYPT(uav.RECORD_ID, '".$vault_key."') = ?");
        $stmt_detail->bind_param("s", $record_id);
        $stmt_detail->execute();
        $stmt_detail->bind_result($user_name, $password, $url, $user_password);
        $stmt_detail->store_result();
        $stmt_detail->fetch();

        if ($stmt_detail->num_rows) {
            $decrypted_pw = secondEn::decrypt($password, $user_password);
            $item_array = array('user_name' => $user_name, 'password' => $decrypted_pw, 'url' => $url);
        
            http_response_code(200);
            $validation_array = array("error" => false, "item" => $item_array);
            echo json_encode($validation_array);
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "fail");
            echo json_encode($validation_array);
        }

        $stmt_detail->close();
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