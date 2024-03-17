<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/PhpClass/ClassCourse.php';
$database = new Database();
$db = $database->getConnection();
$Course = new ClassCourse($db);
$Title = "บทเรียนออนไลน์";
$Resutl = $Course->readLessonsAll(@$_GET['Course']);

$stmt = $Course->CourseMy();
//echo '<pre>';print_r($row); exit();

?>
<?php include_once('../../../pages/Users/Layout/HeaderUser.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include_once('../../../pages/Users/Layout/NavbarTopUser.php') ?>
        <?php include_once('../../../pages/Users/Layout/NavbarLeftUser.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">คอร์สเรียนของฉัน</h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                       
                        <div class="col-md-4">
                        <a href="../Course/CourseView?CourseID=<?=$row['CourseID']?>">
                            <div class="card card-widget widget-user">
                                <div class="widget-user-header text-white"
                                    style="background: url('../../../uploads/Course/<?=$row['CourseImage'];?>') center center;background-size: cover;">
                                    
                                </div>
                                <div class="p-2">
                                    <h5 class="m-0"><?=$row['CourseName']?></h5>
                                    <small>โดย <?=$row['FullName']?></small>   
                                </div>
                            </div>
                            </a>
                        </div>
                        <?php endwhile; ?>

                    </div>
                    <!-- /.row -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Users/Layout/FooterUser.php'); ?>
</body>

</html>