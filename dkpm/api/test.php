<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

$json = file_get_contents('php://input');
$data = json_decode($json);

echo $data->Barcode;


?>