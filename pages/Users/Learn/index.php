<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/PhpClass/ClassLearn.php';
$database = new Database();
$db = $database->getConnection();
$Course = new ClassLearn($db);
$Title = $Course->TitleBar;
$Resutl = $Course->readLessonsAll($_GET['Course']);
$LesSing = $Course->readLessonsSingle($_GET['Course'],$_GET['Leeson']);
//echo '<pre>';print_r();
// while($row = $Resutl->fetch(PDO::FETCH_ASSOC)){
// echo $row['LessonCode'];
// }
//exit();
?>
<?php include_once('../../../pages/Users/Layout/HeaderUser.php') ?>
<style>
    iframe{
        width: 100%;
        height:500px;
    }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include_once('../../../pages/Users/Layout/NavbarTopUser.php') ?>
        <?php include_once('../../../pages/Users/Layout/NavbarLeftUser.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <?php if(empty($_GET['Leeson'])): ?>
                    <div class="vh-100 d-flex justify-content-center align-items-center">
                        <div>
                            <h1>ยินดีต้อนรับ</h1>
                            <p>โปรดเลือกเนื้อหาที่ต้องการเรียนจากสารบัญ</p>
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </div>
                    <?php else:?>                        
                      <?php  $row = $LesSing->fetch(PDO::FETCH_ASSOC);?>  
                     <h2>บทที่ <?=$row['LessonNo']?> <?=$row['LessonTitle']?></h2>
                      <hr>
                      <?=$row['LessonContent']?>


                    <?php endif; ?>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">



                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Users/layout/FooterUser.php'); ?>
</body>

</html>