<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../../pages/Teacher/Course/Php/CourseClass.php'; 
$database = new Database();
$db = $database->getConnection();

$course = new Course($db);
$Title = $course->TitleBar;
// อ่านคอร์สเรียนทั้งหมด
$stmt = $course->read();
$num = $stmt->rowCount();
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
                            <h1 class="m-0"><?=$Title;?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">
                                    <a href="../../../pages/Teacher/Course/CourseInsert" class="btn btn-block btn-primary"><i class="far fa-plus-square"></i> เพิ่มคอร์สเรียน</a>

                                </li>
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
                            <h3 class="card-title">ตารางคอร์สเรียน</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($num > 0) : ?>
                            <table id="Tb_Couesr" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>รหัสคอร์สเรียน</th>
                                        <th>ชื่อคอร์สเรียน</th>
                                        <th>ครูผู้สอน</th>
                                        <th>วันที่สร้าง</th>
                                        <th>บทเรียน</th>
                                        <th>คำสั่ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :?>
                                    <tr>
                                        <td><?=$row['CourseCode'];?></td>
                                        <td><?=$row['CourseName'];?></td>
                                        <td><?=$row['FullNmae'];?></td>
                                        <td><?=$row['CourseDateCreated'];?></td>
                                        <td><a href="../Lesson/LessonMain?CourseID=<?=$row['CourseID']?>" class="btn btn-primary btn-sm"><i class="far fa-plus-square"></i> สร้างบทเรียน</a></td>
                                        <td>
                                            <a href="CourseUpdate?CourseID=<?=$row['CourseID']?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> แก้ไข</a> <a href="http://" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> ลบ</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                <tbody>
                            </table>
                            <?php else :  ?>
                                <div>No courses found.</div>
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