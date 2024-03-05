<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/Home/Php/ClassCourse.php';
$database = new Database();
$db = $database->getConnection();

$Course = new ClassCourse($db);
$stmt = $Course->read();
//echo '<pre>';print_r();

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
                            <h1 class="m-0">คอร์สเรียน</h1>
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
                        <a href="http://">
                            <div class="card card-widget widget-user">
                                <div class="widget-user-header text-white"
                                    style="background: url('../../../pages/Teacher/Course/Uploads/<?=$row['CourseImage'];?>') center center;">
                                    
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle" src="../../../dist/img/user3-128x128.jpg" alt="User Avatar">
                                </div>
                                <div class="card-footer">
                                    <h5 class="m-0"><?=$row['CourseName']?></h5>
                                    <small>โดย <?=$row['FullNmae']?></small> 
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">3,200</h5>
                                                <span class="description-text">ลงทะเบียน</span>
                                            </div>

                                        </div>

                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">13,000</h5>
                                                <span class="description-text">เรียนสำเร็จ</span>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">35</h5>
                                                <span class="description-text">บทเรียน</span>
                                            </div>

                                        </div>

                                    </div>

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


        <?php include_once('../../../pages/Users/layout/FooterUser.php'); ?>
</body>

</html>