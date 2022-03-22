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

$stmt_id = $dkpm_conn->prepare("SELECT ID FROM dkpm.user_account WHERE `USER_EMAIL` = ?");
$stmt_id->bind_param("s", $_POST['user_email']);
$stmt_id->execute();
$stmt_id->bind_result($id);
$stmt_id->store_result();
$stmt_id->fetch();

if ($stmt_id->num_rows) {
    $stmt_password = $dkpm_conn->prepare("SELECT USER_PASSWORD FROM dkpm.user_account WHERE `USER_EMAIL` = ? AND `USER_PASSWORD` = ?");
    $stmt_password->bind_param("ss", $_POST['user_email'], $_POST['user_password']);
    $stmt_password->execute();
    $stmt_password->bind_result($user_password);
    $stmt_password->store_result();
    $stmt_password->fetch();
                            
    if ($stmt_password->num_rows) {
        if ($_POST['user_password'] == $user_password) {
            $validation_array = array("status" => "correct");
            $stmt_addTimes = $dkpm_conn->prepare("UPDATE dkpm.user_account SET LOGIN_TIMES = LOGIN_TIMES + 1 WHERE `ID` = ?");
            $stmt_addTimes->bind_param("s", $id);
            $stmt_addTimes->execute();
        }
    } else {
        $validation_array = array("status" => "wrong");
    }

    $stmt_password->close();
} else {
    $validation_array = array("status" => "invalid");
}

$stmt_id->close();

echo json_encode($validation_array);
 
mysqli_close($dkpm_conn);

?>