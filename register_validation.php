<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

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
        $validation_array = array("error" => true, "status" => "invalid");
        echo json_encode($validation_array);
    } else {
        $now = date("Y-m-d H:i:s");
        $image = implode(",",$_POST['image']);

        $stmt_insertAccount = $dkpm_conn->prepare("INSERT INTO dkpm.user_account (`USER_EMAIL`,`USER_PASSWORD`,`ENCRYPTION`,`REGISTER_TIME`) VALUES (?, ?, ?, ?)");
        $stmt_insertAccount->bind_param("ssss", $_POST['user_email'], $_POST['user_password'], $image, $now);
        $stmt_insertAccount->execute(); 
        echo $dkpm_conn -> error;
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