<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || isset($_SERVER['HTTP_REFERER'])) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die(header("Location: http://dkpm.com/jt3MJLZirM.html"));
}

error_reporting(0);
ini_set('display_errors', 0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

date_default_timezone_set('Asia/Hong_Kong');

//$token = hex2bin(actionEn::reverse("\"$access_token\""));
//$token = hex2bin(secondEn::decrypt($_GET["ALXEjY8McZ"], "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ"));

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);

    die();
} else {
    require_once './yiycotD377gwN7cxpCuA.php';

    //$decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $token = secondEn::decrypt(hex2bin($_GET["tGjsGRc7ge"]), "TKA6GW6aYJkSrDxNkdYqctjmx1jSl2bE1SL551wTK9OamNjNrJNVIL8WVnMF1CH7udOPbzT0F3RSnjPkJBXYFu0Yn0iK2cVWxDRI");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";

    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ? AND VALID_STATUS = 0");
    $stmt_check_account->bind_param("s", $token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();

    if ($stmt_check_account->num_rows) {
        $now = date('Y-m-d H:i:s');

        $one_time_token = bin2hex(random_bytes(100));
        $token = secondEn::encrypt($one_time_token, "TKA6GW6aYJkSrDxNkdYqctjmx1jSl2bE1SL551wTK9OamNjNrJNVIL8WVnMF1CH7udOPbzT0F3RSnjPkJBXYFu0Yn0iK2cVWxDRI");
        $access_token = bin2hex($token);

        $stmt_activate_account = $dkpm_conn->prepare("UPDATE dkpm.user_account SET ONE_TIME_TOKEN = AES_ENCRYPT(NULL, '".$key."'), VALID_STATUS = 1 WHERE AES_DECRYPT(USER_ID, '".$key."') = ? AND AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ? AND VALID_STATUS = 0");
        $stmt_activate_account->bind_param("ss", $user_id, $token);
        $stmt_activate_account->execute(); 
        
        $stmt_insert_log = $dkpm_conn->prepare("INSERT INTO dkpm.user_activation_log (USER_ID, RECORD_TIME, STATUS) VALUES (AES_ENCRYPT(?, '".$activation_log_key."'), ?, ?)");
        $stmt_insert_log->bind_param("ssi", $user_id, $now, $status);
        $stmt_insert_log->execute(); 
        
        header("Location: http://dkpm.com/sjgfW6qC03?gf9TerztbC=".bin2hex($user_id)."&i1X1ukLwLh=".bin2hex('SQ7MpHsUHx')."");
    } else {
        header("Location: http://dkpm.com/jt3MJLZirM.html");
    }

    $stmt_check_account->close();

    mysqli_close($dkpm_conn);

    die();
}

?>