<?php
include_once '../../php/Database/Database.php'; 
include_once '../../php/Login/ClassLogin.php'; 


$database = new Database();
$db = $database->getConnection();

$Login = new ClassLogin($db);

$Login->username = $_POST['username'];
$Login->password = $_POST['password'];

$response = array();

if($Login->LoginAdmin()) {
    echo $Login->LoginAdmin();
} else {
    echo 0;
}

?>