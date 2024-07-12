<?php
// include database and object files
include_once '../../../../php/Database/Database.php'; 
include_once '../../../../pages/Teacher/PhpClass/ClassQuizzes.php';
include_once '../../../../php/Uploadfile/ClassUploader.php';
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare object
$Quiz = new ClassQuizzes($db);


//print_r($_FILES);
//print_r(count($_FILES["OptImg"]["error"]));
//    for ($i=0; $i < count($_FILES["OptImg"]["error"]); $i++) { 
//         //print_r($_FILES["OptImg"]["error"][$i]);
//         if($_FILES["OptImg"]["error"][$i] == 0){
//             echo "มีรูป";
//         }else{
//             echo "ไม่มีรูป";

//             echo $_POST['OptID'][$i];
//         }
//    }
print_r($_POST);
exit();

if($_FILES["UpdateQuestionImg"]["error"] == 0){ 
    $imageUploader = new ClassUploader($_FILES["UpdateQuestionImg"]["name"],$_FILES["UpdateQuestionImg"]["tmp_name"], 500,"Question"); // Resize to 500x500
    $array = json_decode($imageUploader->upload());
    $UpdateQuestion_Img =  $array->Text;
    
}else{
    $UpdateQuestion_Img = "";
    $QuizUpdate = "";
}

$QuizUpdate = $Quiz->QuizzesPhpUpdate($UpdateQuestion_Img);




echo $QuizUpdate;

?>