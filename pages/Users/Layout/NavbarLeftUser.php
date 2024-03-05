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
                <img src="https://cdn-icons-png.flaticon.com/128/456/456212.png" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block" data-toggle="modal" data-target="#ModalLogin">เข้าสู่ระบบ</a>
            </div>
        </div>
        <?php else : ?>
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            
            <div class="info">                
                <div class="">
                ยินดีตอนรับ
                </div>
                <div class="">
                <?=$_SESSION['FullName'];?>
                </div>
                <a href="../../../php/Login/PhpLogoutMain">[ออกจากระบบ]</a>
            </div>
        </div>
        <?php endif; ?>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>


    </div>
    <!-- /.sidebar -->
</aside>

<!-- Modal -->
<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">

                <h2>Login เข้าสู่ระบบ</h2>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">รหัสผ่าน:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
                    <br>
                    <a href="../../Users/Register" class="btn btn-secondary btn-block">สมัครเรียน</a>



                </form>

            </div>
        </div>
    </div>
</div>