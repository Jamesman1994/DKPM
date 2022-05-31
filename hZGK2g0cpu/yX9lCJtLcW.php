<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("Location: https://dkpm.com/jt3MJLZirM.html");
}

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
    // account activation

    require_once './yiycotD377gwN7cxpCuA.php';

    $token = secondEn::decrypt(hex2bin($_GET["ALXEjY8McZ"]), "SSj4MDERqJTSHjNGb2tlM8U3xvBilAjhfy8fHtM9PRJ9tt5M1zLsWbEkHrVSx8ywED7fxUNvP4KEHpPFR0eahzoVHjTGFXEOeVTd");
    //$decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
    $activation_log_key = "cr7ZotJw5g3jtpDQL6GFgwOIXTYfupQFbXW8McKf0ft30oLhSKoFCNzVWjIb5UOGTJKOhkE1lJmjZX9RK2hzeQlx9XTJATrfdCsY";

    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ? AND VALID_STATUS = 0");
    $stmt_check_account->bind_param("s", $token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();

    if ($stmt_check_account->num_rows) {     
        $now = date('Y-m-d H:i:s');
        $status = 1;

        $stmt_activate_account = $dkpm_conn->prepare("UPDATE dkpm.user_account SET ONE_TIME_TOKEN = AES_ENCRYPT(NULL, '".$key."'), VALID_STATUS = 1 WHERE AES_DECRYPT(USER_ID, '".$key."') = ? AND AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ? AND VALID_STATUS = 0");
        $stmt_activate_account->bind_param("ss", $user_id, $token);
        $stmt_activate_account->execute(); 
        
        $stmt_insert_log = $dkpm_conn->prepare("INSERT INTO dkpm.user_activation_log (USER_ID, RECORD_TIME, STATUS) VALUES (AES_ENCRYPT(?, '".$activation_log_key."'), ?, ?)");
        $stmt_insert_log->bind_param("ssi", $user_id, $now, $status);
        $stmt_insert_log->execute(); 
        
        header("Location: http://dkpm.com/Lrs7GzZCK7?rhdl5a2s02=".bin2hex($user_id)."&PuCFroHt8C=".bin2hex('I1KFPkpXtX')."");
    } else {
        header("Location: http://dkpm.com/jt3MJLZirM.html");
    }

    $stmt_check_account->close();

    mysqli_close($dkpm_conn);

    die();
}

?>