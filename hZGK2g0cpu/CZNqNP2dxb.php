<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: https://dkpm.com/jt3MJLZirM.html");
    die();
}

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
    // change password

    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $access_token = hex2bin($data->BQQL4Emv2j);
    $decrypted_token = secondEn::decrypt($access_token, "TKA6GW6aYJkSrDxNkdYqctjmx1jSl2bE1SL551wTK9OamNjNrJNVIL8WVnMF1CH7udOPbzT0F3RSnjPkJBXYFu0Yn0iK2cVWxDRI");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

    $stmt_check_activation = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."'), AES_DECRYPT(IMAGE, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
    $stmt_check_activation->bind_param("s", $decrypted_token);
    $stmt_check_activation->execute();
    $stmt_check_activation->bind_result($user_id, $decrypted_image);
    $stmt_check_activation->store_result();
    $stmt_check_activation->fetch();

    if ($stmt_check_activation->num_rows) {
        $user_password = $data->oAA8vc5r7G;
        $retype_password = $data->pQVeZ6INYC;

        if (preg_match('/[A-Z]+/', $user_password) && preg_match('/[a-z]+/', $user_password) && preg_match('/[\d!$%^&]+/', $user_password) == true && strlen($user_password) >= 8 && strlen($user_password) <= 16) {
            if ($user_password == $retype_password) {
                $now = date("Y-m-d H:i:s");
                //$encrypted_pw = secondEn::encrypt($user_password, $now);
                $stmt_get_register_time = $dkpm_conn->prepare("SELECT AES_DECRYPT(REGISTER_TIME, '".$register_time."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_ID, '".$key."') = ?");
                $stmt_get_register_time->bind_param("s", $user_id);
                $stmt_get_register_time->execute();
                $stmt_get_register_time->bind_result($register_time);
                $stmt_get_register_time->store_result();
                $stmt_get_register_time->fetch();
                $stmt_get_register_time->close();        

                $encrypted_pw = hash('sha512', $register_time.$user_password);
                $encrypted_image = secondEn::encrypt($decrypted_image, $now);

                $stmt_change_password = $dkpm_conn->prepare("UPDATE dkpm.user_account SET USER_PASSWORD = AES_ENCRYPT(?, '".$key."'), IMAGE = AES_ENCRYPT(?, '".$key."'), REGISTER_TIME = ?, ONE_TIME_TOKEN = '' WHERE AES_DECRYPT(USER_ID, '".$key."') = ? AND AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ?");
                $stmt_change_password->bind_param("sssss", $encrypted_pw, $encrypted_image, $now, $user_id, $decrypted_token);
                $stmt_change_password->execute();
                $stmt_change_password->close(); 
                
                http_response_code(200);
                $validation_array = array("error" => false);
                echo json_encode($validation_array);
            } else {
                http_response_code(401);
                $validation_array = array("error" => true, "message" => "different");
                echo json_encode($validation_array);
            }
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "format");
            echo json_encode($validation_array);
        }
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "fail");
        echo json_encode($validation_array);
    }

    $stmt_check_activation->close();

    mysqli_close($dkpm_conn);

    die();
}


?>