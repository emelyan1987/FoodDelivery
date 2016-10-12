<?php

if($api_status == 1)
{

$comma = '';
$json = '[';

    $json .= $comma . '{';
    $json .= '"status":"' . addslashes($api_status) . '",';
    $json .= '"Message":"' . addslashes($api_message) . '",';
    $json .= '"Email":"' . addslashes($email) . '"';
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
    $json .= '"Message":"' . addslashes($api_message) . '"';
    $json .= '}';
    $comma = ',';
$json .= ']';  
}
echo $json;

?>