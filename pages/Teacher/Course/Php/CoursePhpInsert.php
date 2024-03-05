<?php
// include database and object files
include_once '../../../../php/Database/Database.php'; 
include_once '../../../../pages/Teacher/Course/Php/CourseClass.php'; 
include_once '../../../../pages/Teacher/Course/Php/ClassUploader.php'; 
// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare object
$course = new Course($db);

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
    $imageUploader = new ClassUploader($_FILES["CourseImage"], 2048); // Resize to 500x500
    $course->CourseImage = $imageUploader->upload();
}else{
    $course->CourseImage = "";
}

if($course->create()) {
    echo "<div class='alert alert-success'>Course was created.</div>";
} else {
    echo "<div class='alert alert-danger'>Unable to create course.</div>";
}
?>