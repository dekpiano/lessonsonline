<?php
// include database and object files
include_once '../../../../php/Database/Database.php'; 
include_once '../../../../pages/Teacher/PhpClass/ClassCourse.php'; 
include_once '../../../../php/Uploadfile/ClassUploader.php'; 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare object
$course = new ClassCourse($db);

// set course property values
$course->CourseCode = $_POST['CourseCode'];
$course->CourseName = $_POST['CourseName'];
$course->CourseDescription = $_POST['CourseDescription'];
$course->CourseStartDate = $_POST['CourseStartDate'];
$course->CourseEndDate = $_POST['CourseEndDate'];
$course->CourseDuration = $_POST['CourseDuration'];
$course->CourseType = $_POST['CourseType'];
$course->CourseStatus = "Active";
$course->CourseDateCreated = date("Y-m-d H:i:s");
$course->TeacherID = $_SESSION['UserID'];


if($_FILES["CourseImage"]["error"] == 0){ 
    $imageUploader = new ClassUploader($_FILES["CourseImage"]["name"],$_FILES["CourseImage"]["tmp_name"], 2048,"Course"); // Resize to 500x500
    $array = json_decode($imageUploader->upload());
    $course->CourseImage =  $array->Text;
}else{
    $course->CourseImage = "";
}

if($course->create()) {
    echo 1;
} else {
    echo 0;
}
?>