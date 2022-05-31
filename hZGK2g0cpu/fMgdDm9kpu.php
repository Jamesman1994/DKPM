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

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);
    
    die();
} else {
    // get item list

    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    $access_token = hex2bin($data->ca0fkqYjfU);
    $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $vault_key = "LnKkHahknEELy4Ll7wuR1SzJPAnMB5faZ7Vy3cRKWD75Su44GbP0OqQQ3A5vJsYmvwrYmyGhHiFTDXvGyeb7pdBW6Me25PUSRNHn";
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

    $stmt_detail = $dkpm_conn->prepare("SELECT AES_DECRYPT(uav.RECORD_ID, '".$vault_key."'), AES_DECRYPT(uav.ITEM_ICON, '".$vault_key."'), AES_DECRYPT(uav.USER_NAME, '".$vault_key."'), AES_DECRYPT(uav.DOMAIN, '".$vault_key."') FROM dkpm.user_account_vault uav LEFT JOIN dkpm.user_account ua ON AES_DECRYPT(uav.USER_ID, '".$vault_key."') = AES_DECRYPT(ua.USER_ID, '".$key."') WHERE AES_DECRYPT(ua.ONE_TIME_TOKEN, '".$key."') = ? ORDER BY uav.DOMAIN");
    $stmt_detail->bind_param("s", $decrypted_token);
    $stmt_detail->execute();
    $stmt_detail->bind_result($record_id, $item_icon, $user_name, $domain);
    $stmt_detail->store_result();

    $item_array = array();

    if ($stmt_detail->num_rows) {
        while ($stmt_detail->fetch()) {
            $record_array = array('v0pgjk4wxh' => bin2hex($record_id), 'item_icon' => $item_icon, 'user_name' => $user_name, 'domain' => $domain);
            array_push($item_array, $record_array);
        }

        http_response_code(200);
        $validation_array = array("error" => false, "list" => $item_array);
        echo json_encode($validation_array);
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "fail");
        echo json_encode($validation_array);
    }

    mysqli_close($dkpm_conn);

    die();
}

?>