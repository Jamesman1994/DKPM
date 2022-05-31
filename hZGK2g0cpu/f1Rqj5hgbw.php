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

require_once './yiycotD377gwN7cxpCuA.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if (actionEn::check($data->P8j68XP27q, "xKiOei6522KV3fRjIVLYayLoPJmhPKQvJnjPQPK43MxnrTYSiqktkPgyI8WIdrLy2qCKu8qSOLxjw5IYYRwbmUZIVN43MbqKf7b6QDza4tBFr5ht1Eppf5/12iHVlh1K") == false) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "permissions");
    echo json_encode($validation_array);
    die();
} else {
    // forgot password validation

    $dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
    $validation_array = array();

    if ($dkpm_conn->connect_errno) {
        http_response_code(401);
        $validation_array = array("error" => true, "status" => "disconneted");
        echo json_encode($validation_array);
        die();
    } else {
        $user_email = $data->g3xfhtUMYF;
        $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
        $validation_log_key = "BhQpDvK0WnzHjoq6haqZvEbmYUpGsUaqMuRCGMaUOmTbKIVkNICa3x1GQPNxHZZ8t48kx8c7GhIMAFaR2Q4t2E3oVCr4zi9kJ9bg";

        $stmt_error_times = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_validation_log WHERE AES_DECRYPT(USER_EMAIL, '".$validation_log_key."') = ? AND STATUS = 0");
        $stmt_error_times->bind_param("s", $user_email);
        $stmt_error_times->execute();
        $stmt_error_times->bind_result($count);
        $stmt_error_times->store_result();
        $stmt_error_times->fetch();

        if ($count <= 4) {
            $images = $data->s7ew3p8zhx;

            $stmt_image = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."'), AES_DECRYPT(IMAGE, '".$key."'), AES_DECRYPT(REGISTER_TIME, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
            $stmt_image->bind_param("s", $user_email);
            $stmt_image->execute();
            $stmt_image->bind_result($user_id, $encrypted_img, $register_time);
            $stmt_image->store_result();
            $stmt_image->fetch();

            $decrypted_img = secondEn::decrypt($encrypted_img, $register_time);
            $image_array = explode(",",$decrypted_img);

            if ($image_array == $images) {
                $one_time_token = bin2hex(random_bytes(100));
                $token = secondEn::encrypt($one_time_token, "TKA6GW6aYJkSrDxNkdYqctjmx1jSl2bE1SL551wTK9OamNjNrJNVIL8WVnMF1CH7udOPbzT0F3RSnjPkJBXYFu0Yn0iK2cVWxDRI");
                $access_token = bin2hex($token);

                $stmt_update_token = $dkpm_conn->prepare("UPDATE dkpm.user_account set ONE_TIME_TOKEN = AES_ENCRYPT(?, '".$key."') WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
                $stmt_update_token->bind_param("ss", $one_time_token, $user_email);
                $stmt_update_token->execute(); 
                $stmt_update_token->close();
                
                include('EgE8byvN1A.php');

                http_response_code(200);
                $validation_array = array("error" => false, "message" => "success");
                echo json_encode($validation_array);
            } else {
                $now = date('Y-m-d H:i:s');
                $status = 0;

                $stmt_insert_log = $dkpm_conn->prepare("INSERT INTO dkpm.user_validation_log (USER_ID, USER_EMAIL, RECORD_TIME, STATUS) VALUES (AES_ENCRYPT(?, '".$validation_log_key."'), AES_ENCRYPT(?, '".$validation_log_key."'), ?, ?)");
                $stmt_insert_log->bind_param("sssi", $user_id, $user_email, $now, $status);
                $stmt_insert_log->execute();
                $stmt_insert_log->close();    

                $remain_count = 4 - $count;

                http_response_code(401);
                $validation_array = array("error" => true, "message" => "wrong_image", "times" => $remain_count);
                echo json_encode($validation_array);
            }   

            $stmt_image->close();
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "wrong_many_image");
            echo json_encode($validation_array);
        }
    }

    mysqli_close($dkpm_conn);

    die();
}

?>