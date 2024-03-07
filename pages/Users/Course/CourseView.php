<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/PhpClass/ClassCourse.php';
$database = new Database();
$db = $database->getConnection();
$Course = new ClassCourse($db);
$Title = "รายละเอียดคอร์สเรียน";

$Course->CourseCode = $_GET['CourseID'];
$Course->readSingle();



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
                            <h1 class="m-0"><?=$Title;?></h1>
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <section class="content">

                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">คอร์สเรียน <?=$Course->CourseName?></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">ลงทะเบียนเรียน</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">2300</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">เรียนสำเร็จ</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">2000</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">บทเรียนทั้งหมด</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">20</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">

                                                <div class="post">
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm"
                                                            src="<?=$Course->CourseImage?>" alt="user image">
                                                        <span class="username">
                                                            <a href="#">คอร์สเรียน <?=$Course->CourseName?></a>
                                                        </span>
                                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                                    </div>
                                                    <p>
                                                        <?=$Course->CourseDescription?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i>
                                            <?=$Course->CourseName?></h3>
                                        <div class="text-muted">
                                            <p class="text-sm">เปิดให้ลงทะเบียน
                                                <b class="d-block"><?=$Course->CourseStartDate?> ถึง <?=$Course->CourseEndDate?></b>
                                            </p>
                                            <p class="text-sm">เข้าเรียนได้
                                                <b class="d-block"><?=$Course->CourseStartDate?></b>
                                            </p>
                                        </div>
                                        <div class="text-center mt-5 mb-3">
                                            <a href="#" class="btn btn-primary btn-block">ลงทะเบียนเรียน</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Users/layout/FooterUser.php'); ?>
</body>

</html>