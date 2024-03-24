<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/PhpClass/ClassLearn.php';
include_once '../../../pages/Users/PhpClass/ClassRegisterUser.php';
$database = new Database();
$db = $database->getConnection();
$Title = "สมัครเรียน | บทเรียนออนไลน์";
$User = new ClassRegisterUser($db);
$Course = new ClassLearn($db);
$Resutl = $Course->readLessonsAll(@$_GET['Course']); //เมนูซ้าย
$ResutlSing = $Course->readLessonsSingle(@$_GET['Course'],@$_GET['Leeson']);
$rowLesMain = $ResutlSing->fetch(PDO::FETCH_ASSOC); //เนื้อหาแต่ละบท
?>
<?php include_once('../../../pages/Users/Layout/HeaderUser.php') ?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

    <?php include_once('../../../pages/Users/Layout/NavbarHomeUser.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid d-flex justify-content-center">


                    <div class="register-box">

                        <div class="card  mt-3 card card-outline card-primary">
                            <div class="card-header text-center">
                                <div class="h2"><b>สมัครเรียน</b></div>
                            </div>
                            <div class="card-body register-card-body">
                                <form method="post" id="FormRegisterUser" class="needs-validation" novalidate>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="อีเมล" id="Email"
                                            name="Email" required onkeyup="CheckEmailRegister()" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>                                        
                                        <div class="invalid-feedback">กรุณากรอกอีเมล</div> 
                                        <div class="w-100 text-danger" id="emailStatus"></div>                                       
                                    </div>
                                    

                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="รหัสผ่าน" id="Password"
                                            name="Password" required onkeyup="validatePassword()">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกรหัสผ่าน</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน"
                                            required onkeyup="validatePassword()" id="ConfirmPassword" name="ConfirmPassword">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกยืนยันรหัสผ่าน</div>   
                                        <div class="w-100" id="validationMessage"></div>                                    
                                    </div>
                                    
                                    <hr>
                                    <div class="form-group form-check-inline">
                                        <div class="custom-control custom-radio mr-5">
                                            <input class="custom-control-input" type="radio" id="customRadio1"
                                                name="UserGender" value="ชาย"  required>
                                            <label for="customRadio1" class="custom-control-label">ชาย</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2"
                                                name="UserGender" required value="หญิง">
                                            <label for="customRadio2" class="custom-control-label">หญิง</label>
                                        </div>
                                    </div>

                                    <div class="input-group mb-3">
                                        <select name="UserPrefix" id="UserPrefix" class="form-control" required>
                                            <option value="">กรุณาเลือกคำนำหน้า</option>
                                            <option value="เด็กชาย">เด็กชาย</option>
                                            <option value="เด็กหญิง">เด็กหญิง</option>
                                            <option value="นาย">นาย</option>
                                            <option value="นาง">นาง</option>
                                            <option value="นางสาว">นางสาว</option>
                                        </select>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณาเลือกคำนำหน้า</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="ชื่อจริง"
                                            id="UserFirstName" name="UserFirstName" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกชื่อจริง</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="นามสกุลจริง"
                                            id="UserLastName" name="UserLastName" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกนามสกุลจริง</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="เลขบัตรประชาชน 13 หลัก"
                                            id="UserIdCard" name="UserIdCard" required data-inputmask="'mask': '9999999999999'">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกเลขบัตรประชาชน 13 หลัก</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="วันเกิด" id="UserBirthday"
                                            name="UserBirthday" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <i class="fas fa-birthday-cake"></i>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณาเลือกวันเกิด</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="tel" class="form-control" placeholder="เบอร์โทร" id="UserPhone"
                                            name="UserPhone" required data-inputmask="'mask': '9999999999'">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์ </div>
                                    </div>


                                    <button type="submit" id="BtnSubmitRegister" class="btn btn-primary btn-block">สมัครเรียน</button>

                                </form>

                            </div>
                            <!-- /.form-box -->
                        </div><!-- /.card -->
                    </div>

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <?php include_once('../../../pages/Users/Layout/FooterUser.php'); ?>
</body>

</html>