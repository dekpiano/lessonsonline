<?php 
include_once '../../../../php/Database/Database.php'; 
include_once '../../../../Pages/Users/Register/Php/ClassRegisterUser.php';
$database = new Database();
$db = $database->getConnection();
$Title = "";

$User = new ClassRegisterUser($db);

$User->UserCode = $User->getNewUserCode();
$User->UserFirstName = $_POST['UserFirstName'];
$User->UserPrefix = $_POST['UserPrefix'];
$User->UserLastName = $_POST['UserLastName'];
$User->UserBirthday = $_POST['UserBirthday'];
$User->UserPhone = $_POST['UserPhone'];
$User->Username = $_POST['Email'];
$User->Password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
$User->Email = $_POST['Email'];
$User->UserType = "student";
$User->DateCreated = date('Y-m-d H:i:s');

echo $User->create();
?>