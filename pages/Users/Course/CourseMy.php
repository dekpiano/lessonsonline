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
                <div class="card">
        <div class="card-header">
          <h3 class="card-title">Projects</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 15%">
                          #
                      </th>
                      <th style="width: 20%">
                          ชื่อคอร์สเรียน
                      </th>
                      <th style="width: 15%">
                          ผู้เรียน
                      </th>
                      <th>
                          เรียนแล้ว
                      </th>
                      <th style="width: 8%" class="text-center">
                          สถานะ
                      </th>
                      <th style="width: 15%">
                      เรียนต่อ
                      </th>
                  </tr>
              </thead>
              <tbody>
              <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                  <tr>
                      <td>
                          <img src="../../../uploads/Course/<?=$row['CourseImage'];?>" class="img-fluid" alt="คอร์สเรียน" srcset="">
                      </td>
                      <td>
                          <a>
                          <?=$row['CourseName']?>
                          </a>
                          <br>
                          <small>โดย <?=$row['FullName']?></small>   
                      </td>
                      <td>
                         <?php echo $_SESSION['FullName']?>
                      </td>
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                              </div>
                          </div>
                          <small>
                              57% Complete
                          </small>
                      </td>
                      <td class="project-state">
                          <span class="badge badge-success"><?=$row['CourseStatus']?></span>
                      </td>
                      <td class="project-actions">                      
                          <a class="btn btn-info btn-sm" href="../Learn/?Course=<?=$row['CourseID']?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              เข้าเรียน
                          </a>
                          
                      </td>
                  </tr>
                  <?php endwhile; ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
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