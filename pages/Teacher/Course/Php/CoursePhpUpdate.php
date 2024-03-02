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
$course->CourseName = $_POST['CourseName'];
$course->CourseDescription = $_POST['CourseDescription'];
$course->CourseCode = $_POST['CourseCode'];

// create the course
if($course->UpdateCourse()) {
    echo 1;
} else {
    echo 0;
}
?>