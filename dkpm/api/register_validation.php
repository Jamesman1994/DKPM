<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

require_once('./register_auth.php');

//https://stackoverflow.com/questions/9262109/simplest-two-way-encryption-using-php

$dkpm_conn = new mysqli("localhost", "root", "", "dkpm");
$validation_array = array();
if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "status" => "disconneted");
    echo json_encode($validation_array);
} else {
    $stmt_id = $dkpm_conn->prepare("SELECT ID FROM dkpm.user_account WHERE `USER_EMAIL` = ?");
    $stmt_id->bind_param("s", $_POST['user_email']);
    $stmt_id->execute();
    $stmt_id->bind_result($id);
    $stmt_id->store_result();
    $stmt_id->fetch();

    if ($stmt_id->num_rows) {
        http_response_code(401);
        $validation_array = array("error" => true, "status" => "repeat");
        echo json_encode($validation_array);
    } else {
        if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(401);
            $validation_array = array("error" => true, "status" => "email_wrong");
            echo json_encode($validation_array);
        } else {
            if (preg_match('/[A-Z]+/', $_POST['user_password']) && preg_match('/[a-z]+/', $_POST['user_password']) && preg_match('/[\d!$%^&]+/', $_POST['user_password']) == true && strlen($_POST["user_password"]) >= 8 && strlen($_POST["user_password"]) <= 16) {
                if ($_POST['user_password'] == $_POST["retype_password"]) {
                    if (isset($_POST['image'])) {
                        if (count($_POST['image']) > 0) {
                            $now = date("Y-m-d H:i:s");
            
                            $image = implode(",",$_POST['image']);
                            $encrypted_pw = secondEn::encrypt($_POST['user_password'], $now);
                            $encrypted_img = secondEn::encrypt($image, $now);
                            $stmt_insertAccount = $dkpm_conn->prepare("INSERT INTO dkpm.user_account (`USER_EMAIL`,`USER_PASSWORD`,`ENCRYPTION`,`REGISTER_TIME`) VALUES (?, ?, ?, ?)");
                            $stmt_insertAccount->bind_param("ssss", $_POST['user_email'], $encrypted_pw, $encrypted_img, $now);
                            $stmt_insertAccount->execute(); 
                            
                            http_response_code(200);
                            $validation_array = array("error" => false);
                            echo json_encode($validation_array);
                        }
                    } else {
                        http_response_code(401);
                        $validation_array = array("error" => true, "status" => "image_wrong");
                        echo json_encode($validation_array);
                    }
                } else {
                    http_response_code(401);
                    $validation_array = array("error" => true, "status" => "password_wrong");
                    echo json_encode($validation_array);
                }
            } else {
                $validation_array = array("error" => true, "status" => "format_wrong");
                echo json_encode($validation_array);
            }
        }
    }

    $stmt_id->close();
}

/*$secret_key = "6LdKyw4eAAAAACLTFC7p3Y2Qz-M-q56fnjryPkXX";
$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$_POST["recaptcha"]."&remoteip=".$_SERVER["REMOTE_ADDR"];
$row = json_decode(file_get_contents($url), true);
if ($row["success"] == "true") {
    $grecaptcha = "true";
}*/

mysqli_close($dkpm_conn);

?>