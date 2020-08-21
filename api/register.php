<?php 

define('__CONFIG__', true);

require_once '../includes/config.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {

$return =[];

$return ['redirect'] = '/dashboard.php';
$return ['name'] = 'Stuart Summers';

echo json_encode($return, JSON_PRETTY_PRINT);   

} else  {
    exit('test exit');
}
?>