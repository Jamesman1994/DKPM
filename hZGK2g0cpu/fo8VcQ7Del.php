<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: https://dkpm.com/jt3MJLZirM.html");
    die();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

date_default_timezone_set('Asia/Hong_Kong');

require_once './yiycotD377gwN7cxpCuA.php';

$json = file_get_contents("php://input");
$data = json_decode($json);

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
$validation_array = array();

if (actionEn::check($data->rihl1xkQng, "bkhwKz7C7zu/y1qLBGq3G3XR1TzKWnZHKwDN/oQcV5c4kgZ/fg7iLZ6vj99TTTR66eib3N1gmYPVzIlDdHSF3B+rHXm7OTVTtIqw63+Ob2EjPTTPXD+0HLq6JR5eovJk") == false) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "permissions");
    echo json_encode($validation_array);
    die();
} else {
    // register verification

    if ($dkpm_conn->connect_errno) {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "disconneted");
        echo json_encode($validation_array);
        die();
    } else {
        $user_email = $data->user_email;
        $user_password = $data->user_password;
        $retype_password = $data->retype_password;
        $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

        $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(USER_EMAIL, '".$key."') = ?");
        $stmt_check_account->bind_param("s", $user_email);
        $stmt_check_account->execute();
        $stmt_check_account->bind_result($user_id);
        $stmt_check_account->store_result();
        $stmt_check_account->fetch();

        if ($stmt_check_account->num_rows) {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "existed_account");
            echo json_encode($validation_array);
        } else {
            if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                http_response_code(401);
                $validation_array = array("error" => true, "message" => "wrong_email");
                echo json_encode($validation_array);
            } else {
                if (preg_match('/[A-Z]+/', $user_password) && preg_match('/[a-z]+/', $user_password) && preg_match('/[\d!$%^&]+/', $user_password) == true && strlen($user_password) >= 8 && strlen($user_password) <= 16) {
                    if ($user_password == $retype_password) {
                        if (isset($data->image)) {
                            if (count($data->image) > 0) {
                                $now = date("Y-m-d H:i:s");
                                $one_time_token = bin2hex(random_bytes(100));
                                $token = secondEn::encrypt($one_time_token, "SSj4MDERqJTSHjNGb2tlM8U3xvBilAjhfy8fHtM9PRJ9tt5M1zLsWbEkHrVSx8ywED7fxUNvP4KEHpPFR0eahzoVHjTGFXEOeVTd");
                                $access_token = bin2hex($token);
                                $image = implode(",",$data->image);

                                //$encrypted_pw = secondEn::encrypt($user_password, $now);
                                $encrypted_pw = hash('sha512', $now.$user_password);
                                $encrypted_img = secondEn::encrypt($image, $now);
                                $stmt_insert_account = $dkpm_conn->prepare("INSERT INTO dkpm.user_account (USER_ID, USER_EMAIL, USER_PASSWORD, IMAGE, REGISTER_TIME, ONE_TIME_TOKEN, LOCK_TIME) VALUES (AES_ENCRYPT(UUID(), '".$key."'), AES_ENCRYPT(?, '".$key."'), AES_ENCRYPT(?, '".$key."'), AES_ENCRYPT(?, '".$key."'), AES_ENCRYPT(?, '".$key."'), AES_ENCRYPT(?, '".$key."'), AES_ENCRYPT(3600, '".$key."'))");
                                $stmt_insert_account->bind_param("sssss", $user_email, $encrypted_pw, $encrypted_img, $now, $one_time_token);
                                $stmt_insert_account->execute(); 
                                
                                include('bA01f2VvkY.php');

                                http_response_code(200);
                                $validation_array = array("error" => false);
                                echo json_encode($validation_array);

                                $stmt_insert_account->close();
                            }
                        } else {
                            http_response_code(401);
                            $validation_array = array("error" => true, "message" => "wrong_image");
                            echo json_encode($validation_array);
                        }
                    } else {
                        http_response_code(401);
                        $validation_array = array("error" => true, "message" => "wrong_password");
                        echo json_encode($validation_array);
                    }
                } else {
                    $validation_array = array("error" => true, "message" => "wrong_format");
                    echo json_encode($validation_array);
                }
            }
        }

        $stmt_check_account->close();
        
        mysqli_close($dkpm_conn);

        die();
    }
}

?>