<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

$dkpm_conn = new mysqli("localhost", "root", "", "dkpm");
$validation_array = array();
if ($dkpm_conn->connect_errno) {
    $validation_array[] = array("status" => "disconneted");
}

/*$secret_key = "6LdKyw4eAAAAACLTFC7p3Y2Qz-M-q56fnjryPkXX";
$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$_POST["recaptcha"]."&remoteip=".$_SERVER["REMOTE_ADDR"];
$row = json_decode(file_get_contents($url), true);
if ($row["success"] == "true") {
    $grecaptcha = "true";
}*/
$_POST["user_email"] = "jamesmanhoyin@gmail.com";
$_POST["user_password"] = "Jamesman1994";

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
        $stmt_password = $dkpm_conn->prepare("SELECT USER_PASSWORD FROM dkpm.user_account WHERE `USER_EMAIL` = ? AND `USER_PASSWORD` = ?");
        $stmt_password->bind_param("ss", $_POST['user_email'], $_POST['user_password']);
        $stmt_password->execute();
        $stmt_password->bind_result($user_password);
        $stmt_password->store_result();
        $stmt_password->fetch();
                                
        if ($stmt_password->num_rows) {
            if ($_POST['user_password'] == $user_password) {
                http_response_code(200);
                $stmt_addTimes = $dkpm_conn->prepare("UPDATE dkpm.user_account SET LOGIN_TIMES = LOGIN_TIMES + 1 WHERE `ID` = ?");
                $stmt_addTimes->bind_param("s", $id);
                $stmt_addTimes->execute();
                $status = 0;
                $validation_array = array("error" => false);
                echo json_encode($validation_array);
            }
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

mysqli_close($dkpm_conn);

?>