<?php 
include_once '../../../php/Database/Database.php'; 
include_once '../../Users/Register/Php/ClassRegisterUser.php';
$database = new Database();
$db = $database->getConnection();
$Title = "";
$User = new ClassRegisterUser($db);

?>
<?php include_once('../../../pages/Users/Layout/HeaderUser.php') ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php include_once('../../../pages/Users/Layout/NavbarTopUser.php') ?>
        <?php include_once('../../../pages/Users/Layout/NavbarLeftUser.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid d-flex justify-content-center">


                    <div class="register-box">

                        <div class="card  mt-3">
                            <div class="card-body register-card-body">
                                <p class="login-box-msg">สมัครเรียน</p>

                                <form method="post" id="FormRegisterUser" class="needs-validation" novalidate>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="อีเมล" id="Email" name="Email" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกอีเมล</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="รหัสผ่าน" id="Password" name="Password" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกรหัสผ่าน</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกยืนยันรหัสผ่าน</div>
                                    </div>
                                    <hr>
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
                                        <input type="text" class="form-control" placeholder="ชื่อจริง" id="UserFirstName" name="UserFirstName" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกชื่อจริง</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="นามสกุลจริง" id="UserLastName" name="UserLastName" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกนามสกุลจริง</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="วันเกิด" id="UserBirthday" name="UserBirthday" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <i class="fas fa-birthday-cake"></i>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณาเลือกวันเกิด</div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="tel" class="form-control" placeholder="เบอร์โทร" id="UserPhone" name="UserPhone" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์ </div>
                                    </div>


                                    <button type="submit" class="btn btn-primary btn-block">สมัครเรียน</button>

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


        <?php include_once('../../../pages/Users/layout/FooterUser.php'); ?>
</body>

</html>