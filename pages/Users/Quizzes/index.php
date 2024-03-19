<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/PhpClass/ClassLearn.php';
include_once '../../Users/PhpClass/ClassQuizzesUser.php';
$database = new Database();
$db = $database->getConnection();
$Course = new ClassLearn($db);
$Quiz = new ClassQuizzesUser($db);
$Title = $Course->TitleBar;
$Resutl = $Course->readLessonsAll(@$_GET['Course']);
$ResutlSing = $Course->readLessonsAll(@$_GET['Course']);
$LesSing = $Course->readLessonsSingle(@$_GET['Course'],@$_GET['Leeson']);
$rowLesMain = $ResutlSing->fetch(PDO::FETCH_ASSOC);
//$rowLesSingTitle = $LesSing->fetch(PDO::FETCH_ASSOC);

$ShowQuiz = $Quiz->readQuiz(@$_GET['Course'],@$_GET['Leeson']);

?>
<?php include_once('../../../pages/Users/Layout/HeaderUser.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include_once('../../../pages/Users/Layout/NavbarTopUser.php') ?>
        <?php include_once('../../../pages/Users/Layout/NavbarLeftUser.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">แบบทดสอบ บทที่ <?=$rowLesMain['LessonNo']?> <?=$rowLesMain['LessonTitle']?>
                        </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <?php while ($row = $ShowQuiz->fetch(PDO::FETCH_ASSOC)) :?>
                    <div class="card">
                        <div class="card-header bg-gradient-gray">
                            <?= $row['QuestionText'];?>
                        </div>
                        <div class="card-body">
                            555
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Users/Layout/FooterUser.php'); ?>
</body>

</html>