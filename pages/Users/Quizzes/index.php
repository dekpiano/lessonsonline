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
$Viewscore = $Quiz->Viewscore($rowLesMain['LessonID']);
$ViewAnswerIsCorrect = $Quiz->ViewAnswerIsCorrect($rowLesMain['LessonID']);
// print_r($ShowQuiz->fetch(PDO::FETCH_ASSOC));
// exit();
?>
<?php include_once('../../../pages/Users/Layout/HeaderUser.php') ?>

<style>
/* ซ่อน radio buttons แท้จริง */
input[type="radio"] {
    display: none;
}

/* สร้างรูปลักษณ์ของปุ่ม radio */
.radio-button {
    display: inline-block;
    background-color: #ffffff;
    color: black;
    padding: 17px 25px;
    border: 2px solid #007bff;
    border-radius: 5px;
    cursor: pointer;
}

/* การเลือก radio button แล้ว */
input[type="radio"]:checked+label {
    background-color: #007bff;
    color: #ffffff;
}

input[type="radio"]:hover+label {
    background-color: #007bff;
    color: #ffffff;
}

/* สร้างลักษณะของ label เพื่อกำหนดรูปลักษณ์ของปุ่ม */
.radio-button-label {
    display: inline-block;
    padding: 17px 25px;
    border-radius: 5px;
    cursor: pointer;
}
</style>

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
                            <h5>( <?=$Viewscore['SumScore']?>/<?=$Viewscore['CountAll']?> คะแนน )</h5>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="javascript:history.go(-1)"><i
                                            class="fas fa-arrow-left"></i> กลับหน้าบทเรียน</a></li>
                                <li class="breadcrumb-item active">แบบทดสอบ</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form id="FormCheckAnswers" class="needs-validation" novalidate>

                        <?php $i = 1; while ($row = $ShowQuiz->fetch(PDO::FETCH_ASSOC)) : ?>
                        <input type="hidden" id="QuestionID" name="QuestionID[]" value="<?=$row['QuestionID']?>">
                        <input type="hidden" id="QuestionID" name="UserAnswerCategory"
                            value="<?=$_GET['AnswerCategory']?>">
                        <?php $CheckAnsFull =  explode(',',$row['OptAnswerArray'])?>
                        <div class="card">
                            <div class="card-header bg-gradient-secondary h4 p-5">
                                <?=$i?>. <?= $row['QuestionText'];?>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach (explode(',',$row['OptChoiceArray']) as $key => $value): ?>
                                    <?php if($value == $ViewAnswerIsCorrect[$row['QuestionID']][0] && ($ViewAnswerIsCorrect[$row['QuestionID']][1] == 1 && $CheckAnsFull[$key] == 1)){
                                            $Checked = "checked";
                                            $style = "style='background-color: #28a745;'";
                                        }else {
                                            $Checked = "";
                                            $style = "";
                                        }

                                        if($value == $ViewAnswerIsCorrect[$row['QuestionID']][0] && ($ViewAnswerIsCorrect[$row['QuestionID']][1] == 0 && $CheckAnsFull[$key] == 0)){
                                            $Checked = "checked";
                                            $style = "style='background-color: #dc3545;'";
                                        }
                                        
                                        ?>
                                    <div class="col-md-6">
                                        <input type="radio" id="<?=$row['QuestionID'].$key;?>"
                                            name="OptChoice<?=$row['QuestionID']?>" value="<?=$value;?>" required
                                            <?=$Checked?>>
                                        <label for="<?=$row['QuestionID'].$key;?>"
                                            class="radio-button-label radio-button w-100" <?=$style?>>
                                            <?=$value?> 
                                        </label>
                                        <div class="invalid-feedback">กรุณาเลือกคำตอบ!</div>
                                    </div>

                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>
                        <?php $i++; endwhile; ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mb-5">ส่งคำตอบ</button>
                        </div>
                    </form>
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Users/Layout/FooterUser.php'); ?>
</body>

</html>