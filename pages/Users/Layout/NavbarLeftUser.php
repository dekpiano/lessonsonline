<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../../" class="brand-link">
        <img src="../../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">บทเรียนออนไลน์</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <?php if(!@$_SESSION['UserType']) :?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <i class="fas fa-sign-in-alt fa-2x"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block" data-toggle="modal" data-target="#ModalLogin">เข้าสู่ระบบ</a>
            </div>
        </div>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <i class="fas fa-user-plus fa-2x"></i>
            </div>
            <div class="info">
                <a href="../Register" class="d-block">สมัครเรียน</a>
            </div>
        </div>
        <?php else : ?>
        <div class="user-panel mt-3 pb-3 mb-3">
            <div class="d-flex align-items-center">
                <div class="image">
                    <img src="https://cdn-icons-png.flaticon.com/128/456/456212.png" class="img-circle elevation-2"
                        alt="User Image">
                </div>
                <div class="info">
                    <div class="">
                        ยินดีตอนรับ
                    </div>
                    <div class="">
                        <?=$_SESSION['FullName'];?>
                    </div>
                </div>
            </div>           
            
        </div>
        <?php endif; ?>

        <?php if(!empty($_SESSION['UserID'])): ?>
            <h5><?=@$rowLesMain['CourseName']?></h5>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php while($row = $Resutl->fetch(PDO::FETCH_ASSOC)) :?>               
            <li class="nav-item">
                <a href="?Course=<?=@$_GET['Course']?>&Leeson=<?=$row['LessonNo']?>" class="nav-link <?= @$_GET['Course'] == $row['CourseID'] && @$_GET['Leeson'] == $row['LessonNo'] ? "active":""?> ">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p>
                        บทที่ <?=$row['LessonNo']?> <?=$row['LessonTitle']?>
                        <?=@$rowLesSingTitle['LessonStudyTime']?>
                        <span id="LessonNo<?=$row['LessonNo']?>" class="badge badge-success right"> <i class="fas fa-check" style="margin-left: 0rem"></i> </span>
                    </p>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Modal -->
<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <h2>Login เข้าสู่ระบบ </h2>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">รหัสผ่าน:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt fa-1x"></i> เข้าสู่ระบบ</button>
                    <br>
                    <a href="../../Users/Register" class="btn btn-secondary btn-block"><i class="fas fa-user-plus fa-1x"></i> สมัครเรียน</a>



                </form>

            </div>
        </div>
    </div>
</div>