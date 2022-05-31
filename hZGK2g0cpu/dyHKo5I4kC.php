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

require_once './yiycotD377gwN7cxpCuA.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

if (actionEn::check($data->hYaIoywq21, "gtNpQjum6UrXFPmMpYa8RUKIAu2xxrlwyZccaU52FoemeohNWHiUKmKT776S3/aQR3DuzR8Q+KyxZSV6llabkvxh+V+3Bk9IL6qRIo3tIuPSHATA2NPaNP8QK7RJmsUK") == false) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "permissions");
    echo json_encode($validation_array);
    die();
} else {
    // forgot password

    $dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
    $validation_array = array();

    if ($dkpm_conn->connect_errno) {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "disconneted");
        echo json_encode($validation_array);
    } else {
        $user_email = $data->ylOHLXQ41B;
        $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
        $validation_log_key = "BhQpDvK0WnzHjoq6haqZvEbmYUpGsUaqMuRCGMaUOmTbKIVkNICa3x1GQPNxHZZ8t48kx8c7GhIMAFaR2Q4t2E3oVCr4zi9kJ9bg";

        $stmt_error_times = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_validation_log WHERE AES_DECRYPT(USER_EMAIL, '".$validation_log_key."') = ? AND STATUS = 0");
        $stmt_error_times->bind_param("s", $user_email);
        $stmt_error_times->execute();
        $stmt_error_times->bind_result($count);
        $stmt_error_times->store_result();
        $stmt_error_times->fetch();

        if ($count <= 4) { 
            $stmt_image = $dkpm_conn->prepare("SELECT AES_DECRYPT(IMAGE, '".$key."'), AES_DECRYPT(REGISTER_TIME, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
            $stmt_image->bind_param("s", $user_email);
            $stmt_image->execute();
            $stmt_image->bind_result($encrypted_img, $register_time);
            $stmt_image->store_result();
            $stmt_image->fetch();

            if ($stmt_image->num_rows) {
                $decrypted_img = secondEn::decrypt($encrypted_img, $register_time);
                $image_array = explode(",",$decrypted_img);
                $image_list = array();

                for ($j = 0; $j < 4; $j++) {
                    array_push($image_list, 'https://images.unsplash.com/photo-'.$image_array[$j].'?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=130&q=80&w=190');
                }

                shuffle($image_list);

                http_response_code(200);
                $validation_array = array("error" => false, "image" => $image_list);
                echo json_encode($validation_array);
            } else {
                http_response_code(401);
                $validation_array = array("error" => true, "message" => "wrong");
                echo json_encode($validation_array);
            }   

            $stmt_image->close();
        } else {
            $stmt_update_status = $dkpm_conn->prepare("UPDATE dkpm.user_account SET VALID_STATUS = 2, ONE_TIME_TOKEN = AES_DECRYPT(NULL, '".$key."') WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
            $stmt_update_status->bind_param("s", $user_email);
            $stmt_update_status->execute();
            $stmt_update_status->close();

            http_response_code(401);
            $validation_array = array("error" => true, "message" => "wrong_many_image");
            echo json_encode($validation_array);
        }
    }

    mysqli_close($dkpm_conn);

    die();
}

?>