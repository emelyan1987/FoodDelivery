<?php
error_reporting(0);
if($api_status == 1)
{

$comma = '';
$json = '[';

    $json .= $comma . '{';
    $json .= '"status":"' . addslashes($api_status) . '",';
    $json .= '"message":"' . addslashes($api_message) . '",';
    $json .= '"username":"' . addslashes($userData['username']) . '",';
    $json .= '"email":"' . addslashes($userData['email']) . '",';
    $json .= '"website":"' . addslashes($userData['website']) . '",';
    $json .= '"first_name":"' . addslashes($userData['f_name']) . '",';
    $json .= '"last_name":"' . addslashes($userData['l_name']) . '",';
    $json .= '"mobile_no":"' . addslashes($userData['mobile']) . '",';
    $json .= '"image":"' . addslashes($userData['image']) . '"';
    $json .= '}';
    $comma = ',';
$json .= ']'; 
}
else
{
$comma = '';
$json = '[';

    $json .= $comma . '{';
    $json .= '"status":"' . addslashes($api_status) . '",';
    $json .= '"message":"' . addslashes($api_message) . '"';
    $json .= '}';
    $comma = ',';
$json .= ']';  
}
echo $json;

?>