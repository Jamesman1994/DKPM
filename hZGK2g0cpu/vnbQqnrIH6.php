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

require_once './yiycotD377gwN7cxpCuA.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");

$token = hex2bin($data->TmwU0hRq5G);

if (actionEn::check($token, "MkaxbzdpVEMHQ0luZPTNF9hTrT2lAr/7dc5VWWa7xY+iodnOaKfUUWN/X5ZOJs4QT6SZOEow2A70SeXXcP53bYxaB09XH+cmEJppit1ZxrWwSEt12CK26F+iecAe1LaB") == false) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "permissions");
    echo json_encode($validation_array);

    die();
} else {
    // check activation

    if ($dkpm_conn->connect_errno) {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "disconneted");
        echo json_encode($validation_array);

        die();
    } else {
        //$user_id = hex2bin($data->Y1lO0AX9p4);
        $access_token = hex2bin($data->Y1lO0AX9p4);
        $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
        $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

        $stmt_check_activation = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_account WHERE AES_DECRYPT(USER_ID, '".$key."') = ? AND VALID_STATUS = 0");
        $stmt_check_activation->bind_param("s", $user_id);
        $stmt_check_activation->execute();
        $stmt_check_activation->bind_result($count);
        $stmt_check_activation->store_result();
        $stmt_check_activation->fetch();

        if ($count == 1) {
            http_response_code(200);
            $validation_array = array("error" => false);
            echo json_encode($validation_array);
        } else {
            http_response_code(401);
            $validation_array = array("error" => true);
            echo json_encode($validation_array);
        }

        $stmt_check_activation->close();

        mysqli_close($dkpm_conn);

        die();
    }

}

?>