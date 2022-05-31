<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: https://dkpm.com/jt3MJLZirM.html");
    die();
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$dkpm_conn = new mysqli("dkpm.com", "dkpm_db", "rTvZF2W9597YZrP9lbal", "dkpm");
if ($dkpm_conn->connect_errno) {
    
} else {
    // installation record
    
    $location_json = file_get_contents("php://input");
    $location_data = json_decode($location_json);
    
    $query = $location_data->query;
    $country = $location_data->country;
    $countryCode = $location_data->countryCode;
    $city = $location_data->city;
    $lat = $location_data->lat;
    $lon = $location_data->lon;
    $timezone = $location_data->timezone;
    $isp = $location_data->isp;
    $now = date("Y-m-d H:i:s");

    $stmt_ip = $dkpm_conn->prepare("SELECT IP_ADDRESS FROM dkpm.user_installation WHERE `IP_ADDRESS` = ?");
    $stmt_ip->bind_param("s", $query);
    $stmt_ip->execute();
    $stmt_ip->bind_result($ip_address);
    $stmt_ip->store_result();
    $stmt_ip->fetch();

    if (($stmt_ip->num_rows) <= 0) {
        $stmt_add = $dkpm_conn->prepare("INSERT INTO dkpm.user_installation VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt_add->bind_param("ssssddsss", $query, $country, $countryCode, $city, $lat, $lon, $timezone, $isp, $now);
        $stmt_add->execute();
        $stmt_add->close();
    }

    $stmt_ip->close();

    mysqli_close($dkpm_conn);
    die();
}

?>