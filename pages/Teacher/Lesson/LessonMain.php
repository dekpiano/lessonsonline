<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../../pages/Teacher/Lesson/Php/ClassLesson.php'; 
$database = new Database();
$db = $database->getConnection();

$Lesson = new ClassLesson($db);
$Title = "สร้างบทเรียน";

$Lesson->CourseID = $_GET['CourseID']; 

// อ่านบทเรียนทั้งหมด
$stmt = $Lesson->read();
$num = $stmt->rowCount();

$Lesson->readCourse(); 

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
                        <div class="col-sm-8">
                            <h1 class="m-0"><?=$Title;?> จากคอร์สเรียน <?=$Lesson->CourseName?> <small>(รหัส
                                    <?=$Lesson->CourseCode?>)</small></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                        href="javascript:history.go(-1)">กลับไปหน้าคอร์สเรียน</a></li>
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
                        <div class="card-header">
                            <div class="d-flex justify-content-between  align-items-center">
                                <h3 class="card-title">ตารางบทเรียน</h3>
                                <a href="../../../pages/Teacher/Lesson/LessonInsert?CourseID=<?=$Lesson->CourseID?>"
                                    class="btn btn-primary">เพิ่มบทเรียน</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($num > 0) : ?>
                            <table id="Tb_Couesr" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>บทเรียนที่</th>
                                        <th>ชื่อบทเรียน</th>
                                        <th>วันที่สร้าง</th>
                                        <th>สร้างแบบทดสอบ</th>
                                        <th>คำสั่ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :?>
                                    <tr>
                                        <td><?=$row['LessonNo'];?></td>
                                        <td><?=$row['LessonTitle'];?></td>
                                        <td><?=$row['LessonDateCreated'];?></td>
                                        <td><a href="Lesson?LessonID=<?=$row['LessonID']?>"
                                                class="btn btn-primary btn-sm">สร้างแบบทดสอบ</a></td>
                                        <td>
                                            <a href="LessonUpdate?LessonID=<?=$row['LessonID']?>"
                                                class="btn btn-warning btn-sm">แก้ไข</a> 
                                                <a href="http://"
                                                class="btn btn-danger btn-sm">ลบ</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <tbody>
                            </table>
                            <?php else :  ?>
                            <div>No Lessons found.</div>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-body -->
                    </div>


                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Teacher/layout/FooterTeacher.php'); ?>
</body>

</html>