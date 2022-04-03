<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

require_once('./register_auth.php');

$data = array(
    'secret' => "0x5606ccBCe6844DB91900Ab9c85046cdC87277239",
    'response' => $_POST['hcaptcha']
);
$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
// var_dump($response);
$responseData = json_decode($response);
echo $response;

/*if($responseData->success) {
    // your success code goes here
    echo "t";
} 
else {
    // return error to user; they did not pass
}

/*$dkpm_conn = new mysqli("localhost", "root", "", "dkpm");
$validation_array = array();
if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "status" => "disconneted");
    echo json_encode($validation_array);
} else {
    $now = date("Y-m-d H:i:s");
    $minutes_ago = date("Y-m-d H:i:s", strtotime('-15 minutes'));

    $stmt_id = $dkpm_conn->prepare("SELECT ID FROM dkpm.user_account WHERE `USER_EMAIL` = ?");
    $stmt_id->bind_param("s", $_POST['user_email']);
    $stmt_id->execute();
    $stmt_id->bind_result($id);
    $stmt_id->store_result();
    $stmt_id->fetch();

    if ($stmt_id->num_rows) {
        $stmt_countLog = $dkpm_conn->prepare("SELECT COUNT(LOGIN_STATUS) as `COUNT` FROM dkpm.user_login_log WHERE `ID` = ? AND LOGIN_TIME BETWEEN ? AND ?");
        $stmt_countLog->bind_param("sss", $id, $now, $minutes_ago);
        $stmt_countLog->execute();
        $stmt_countLog->bind_result($count);
        $stmt_countLog->store_result();
        $stmt_countLog->fetch();

        if ($count < 5) { 
            $stmt_password = $dkpm_conn->prepare("SELECT USER_PASSWORD, REGISTER_TIME FROM dkpm.user_account WHERE `USER_EMAIL` = ?");
            $stmt_password->bind_param("s", $_POST['user_email']);
            $stmt_password->execute();
            $stmt_password->bind_result($user_password, $register_time);
            $stmt_password->store_result();
            $stmt_password->fetch();

            $decrypted_pw = secondEn::decrypt($user_password, $register_time);
                                    
            if ($_POST['user_password'] == $decrypted_pw) {
                $stmt_addTimes = $dkpm_conn->prepare("UPDATE dkpm.user_account SET LOGIN_TIMES = LOGIN_TIMES + 1 WHERE `ID` = ?");
                $stmt_addTimes->bind_param("s", $id);
                $stmt_addTimes->execute();
                $status = 0;
                http_response_code(200);
                $validation_array = array("error" => false);
                echo json_encode($validation_array);
            } else {
                http_response_code(401);
                $validation_array = array("error" => true, "status" => "wrong");
                $status = 1;
                echo json_encode($validation_array);
            }

            $stmt_addLog = $dkpm_conn->prepare("INSERT INTO dkpm.user_login_log (ID, LOGIN_STATUS, LOGIN_TIME) VALUES (?, ?, ?)");
            $stmt_addLog->bind_param("iis", $id, $status, $now);
            $stmt_addLog->execute();
            $stmt_addLog->close();

            $stmt_password->close();
        } else {
            http_response_code(401);
            $validation_array = array("error" => true, "status" => "wrong many");
            echo json_encode($validation_array);
        }
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "status" => "invalid");
        echo json_encode($validation_array);
    }

    $stmt_id->close();
}*/

/*$secret_key = "6LdKyw4eAAAAACLTFC7p3Y2Qz-M-q56fnjryPkXX";
$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$_POST["recaptcha"]."&remoteip=".$_SERVER["REMOTE_ADDR"];
$row = json_decode(file_get_contents($url), true);
if ($row["success"] == "true") {
    $grecaptcha = "true";
}

mysqli_close($dkpm_conn)*/;

?>