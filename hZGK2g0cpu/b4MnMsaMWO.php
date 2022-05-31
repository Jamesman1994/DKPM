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

date_default_timezone_set('Asia/Hong_Kong');

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);
    die();
} else {
    // check activation

    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $access_token = hex2bin($data->Lpv7lD0BKP);
    $decrypted_token = secondEn::decrypt($access_token, "TKA6GW6aYJkSrDxNkdYqctjmx1jSl2bE1SL551wTK9OamNjNrJNVIL8WVnMF1CH7udOPbzT0F3RSnjPkJBXYFu0Yn0iK2cVWxDRI");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

    $stmt_check_activation = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ? AND VALID_STATUS = 1");
    $stmt_check_activation->bind_param("s", $decrypted_token);
    $stmt_check_activation->execute();
    $stmt_check_activation->bind_result($count);
    $stmt_check_activation->store_result();
    $stmt_check_activation->fetch();

    if ($count == 1) {
        http_response_code(200);
        $validation_array = array("error" => false);
        echo json_encode($validation_array);
        die();
    } else {
        http_response_code(401);
        $validation_array = array("error" => true);
        echo json_encode($validation_array);
        die();
    }

    $stmt_check_activation->close();
}

?>