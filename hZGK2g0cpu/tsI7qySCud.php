<?php 

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || isset($_SERVER['HTTP_REFERER'])) {
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    die(header("Location: http://dkpm.com/jt3MJLZirM.html"));
}

error_reporting(0);
ini_set('display_errors', 0);

date_default_timezone_set('Asia/Hong_Kong');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");

if ($dkpm_conn->connect_errno) {
    http_response_code(401);
    $validation_array = array("error" => true, "message" => "disconneted");
    echo json_encode($validation_array);

    die();
} else {
    // check vault
    
    require_once './yiycotD377gwN7cxpCuA.php';

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $access_token = hex2bin($data->polLPpfH7i);
    $decrypted_token = secondEn::decrypt($access_token, "ZndNcO2EbF5DDNf5TMGbnkALUu8cnkhcfgaotM4g6VqBSS61H6FkTHc2HoUkogSzWIpz3XNWOvVoIW89rYL8h0LZ7UZ2LmgS8gKyDJ3FH7iJK99t5dwtTzyn8VuJcQmZ");
    $user_name = $data->user_name;
    $domain = $data->domain;
    
    $key = "xmFzWWpbyz7UYkhw8f538jy522NGcSFNbUV85yMZQlAXbKtF6kdZ3purPCap9HXapCYI8FrIEn92knMIz3j9PuHbFxHENOj1hQcm";
    $vault_log_key = "yPU5wRlYACYV3gGXw2si0fBBChaDt8FuOzmtIyRGS5nnZ3Mpl6yYM3GrqVufnedbu8OmeTpysWbv04zIILCKqZ1VqXYYEcA7B2ZP";

    $stmt_check_account = $dkpm_conn->prepare("SELECT AES_DECRYPT(USER_ID, '".$key."') FROM dkpm.user_account WHERE AES_DECRYPT(ONE_TIME_TOKEN, '".$key."') = ? AND VALID_STATUS = 1");
    $stmt_check_account->bind_param("s", $decrypted_token);
    $stmt_check_account->execute();
    $stmt_check_account->bind_result($user_id);
    $stmt_check_account->store_result();
    $stmt_check_account->fetch();

    if ($stmt_check_account->num_rows) {
        $stmt_check_vault = $dkpm_conn->prepare("SELECT COUNT(*) AS 'COUNT' FROM dkpm.user_vault_log WHERE AES_DECRYPT(USER_ID, '".$vault_log_key."') = ? AND AES_DECRYPT(USER_NAME, '".$vault_log_key."') = ? AND AES_DECRYPT(DOMAIN, '".$vault_log_key."') = ?");
        $stmt_check_vault->bind_param("sss", $user_id, $user_name, $domain);
        $stmt_check_vault->execute();
        $stmt_check_vault->bind_result($count);
        $stmt_check_vault->store_result();
        $stmt_check_vault->fetch();

        if ($count > 0) {
            http_response_code(401);
            $validation_array = array("error" => true, "message" => "fail");
            echo json_encode($validation_array);
        } else {
            http_response_code(200);
            $validation_array = array("error" => false, "message" => "success");
            echo json_encode($validation_array);
        }
    } else {
        http_response_code(401);
        $validation_array = array("error" => true, "message" => "fail");
        echo json_encode($validation_array);
    }

    $stmt_check_account->close();

    mysqli_close($dkpm_conn);

    die();
}

?>