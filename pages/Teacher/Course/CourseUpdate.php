<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../../pages/Teacher/Course/Php/CourseClass.php'; 

$Title = "แก้ไขข้อมูลคอร์สเรียน";
// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare object
$course = new Course($db);
$course->CourseID = $_GET['CourseID']; 
$course->readSingle();


?>

<?php include_once('../../../pages/Teacher/Layout/HeaderTeacher.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include_once('../../../pages/Teacher/Layout/NavbarTopTeacher.php') ?>
        <?php include_once('../../../pages/Teacher/Layout/NavbarLeftTeacher.php') ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?=$Title?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">คอร์สเรียน</a></li>
                                <li class="breadcrumb-item active"><?=$Title?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-body">
                        
                                <form method="post" id="courseFormUpdate">
                                    <div class="mb-3 mt-3">
                                        <label for="courseCode" class="form-label">รหัสคอร์ส:</label>
                                        <input type="text" class="form-control" id="CourseCode" name="CourseCode"
                                            placeholder="Enter course code" value="<?=$course->CourseCode?>" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="CourseName" class="form-label">ชื่อคอร์ส:</label>
                                        <input type="text" class="form-control" id="CourseName" name="CourseName"
                                            placeholder="Enter course title" value="<?=$course->CourseName?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="CourseDescription" class="form-label">รายละเอียดคอร์ส:</label>
                                        <textarea class="form-control" id="CourseDescription" name="CourseDescription" rows="3"
                                           ><?=$course->CourseDescription?></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                </form>
                           
                        </div>
                    </div>

                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Teacher/layout/FooterTeacher.php'); ?>
</body>

</html>