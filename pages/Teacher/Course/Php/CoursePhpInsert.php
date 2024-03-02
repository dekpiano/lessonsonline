<?php
// include database and object files
include_once '../../../../php/Database/Database.php'; 
include_once '../../../../pages/Teacher/Course/Php/CourseClass.php'; 

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare object
$course = new Course($db);

// set course property values
$course->CourseCode = $_POST['CourseCode'];
$course->CourseName = $_POST['CourseName'];
$course->CourseDescription = $_POST['CourseDescription'];
$course->CourseDateCreated = date("Y-m-d H:i:s");
$course->TeacherID = $_SESSION['UserID'];

// create the course
if($course->create()) {
    echo "<div class='alert alert-success'>Course was created.</div>";
} else {
    echo "<div class='alert alert-danger'>Unable to create course.</div>";
}
?>