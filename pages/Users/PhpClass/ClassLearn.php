<?php
date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า Time Zone ตามที่ต้องการ

class ClassLearn {
    private $conn;
    private $table_name = "tb_lessons";

    public $TitleBar = "บทเรียน";
    public $CourseID;
    public $CourseName;
    public $CourseDescription;
    public $TeacherID;
    public $CourseDateCreated;

    public function __construct($db) {
        $this->conn = $db;

        if(empty($_SESSION['UserID']) && @!$_SESSION['UserType'] == "student"){
            header("Location: ../../../");
            exit();
        }
    }


    // อ่านข้อมูลคอร์สเรียนทั้งหมด
    public function read() {
        $query = "SELECT tb_courses.*,CONCAT(tb_users.UserPrefix,tb_users.UserFirstName,' ',tb_users.UserLastName) As FullNmae FROM tb_courses JOIN tb_users ON tb_courses.TeacherID = tb_users.UserID";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE CourseID = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(1, $this->CourseID);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //print_r($row);
        // กำหนดค่าให้กับ properties
        $this->CourseCode = $row['CourseCode'];
        $this->CourseName = $row['CourseName'];
        $this->CourseDescription = $row['CourseDescription'];
        $this->CourseImage = $row['CourseImage'];
        $this->CourseStartDate = $row['CourseStartDate'];
        $this->CourseEndDate = $row['CourseEndDate'];
        $this->CourseImage = $row['CourseImage'];
    }

    public function readLessonsAll($CourseID) {
        $query = "SELECT tb_lessons.*,tb_courses.CourseName 
        FROM tb_lessons 
        JOIN tb_courses ON tb_courses.CourseID = tb_lessons.CourseID
        WHERE tb_lessons.CourseID = ? ORDER BY tb_lessons.LessonNo ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $CourseID);
        $stmt->execute();
        return $stmt;
    }

    public function readLessonsSingle($CourseID,$LessonNo) {
        $query = "SELECT tb_lessons.*,tb_courses.CourseName FROM tb_lessons 
        JOIN tb_courses ON tb_courses.CourseID = tb_lessons.CourseID
        WHERE tb_lessons.CourseID = ? AND tb_lessons.LessonNo = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $CourseID);
        $stmt->bindParam(2, $LessonNo);
        $stmt->execute();
        return $stmt;
    }

    public function LessonsProgressInsert($CourseID,$LessonNo) {

        $QueryErollment = "SELECT * FROM tb_enrollments WHERE CourseID = ? AND UserID = ?";
        $stmtEroll = $this->conn->prepare($QueryErollment);
        $stmtEroll->bindValue(1, $CourseID);
        $stmtEroll->bindValue(2, $_SESSION['UserID']);
        $stmtEroll->execute();
        $rowEroll = $stmtEroll->fetch(PDO::FETCH_ASSOC);

        $QueryLessonPro = "SELECT * FROM  tb_lesson_progress WHERE EnrollmentID = ? AND LessonID = ?";
        $stmtLessonPro = $this->conn->prepare($QueryLessonPro);
        $stmtLessonPro->bindValue(1, $rowEroll['EnrollmentID']);
        $stmtLessonPro->bindValue(2, $LessonNo);
        $stmtLessonPro->execute();
        $rowELessonPro = $stmtLessonPro->fetch(PDO::FETCH_ASSOC);

        $rowCount = $stmtLessonPro->rowCount();
        if($rowCount == 0){       
            $query = "INSERT INTO tb_lesson_progress SET EnrollmentID=:EnrollmentID,LessonID=:LessonID,LessProLastAccessed=:LessProLastAccessed";
            $stmt = $this->conn->prepare($query);       
            $stmt->bindValue(":EnrollmentID", $rowEroll['EnrollmentID']);
            $stmt->bindValue(":LessonID", $LessonNo);
            $stmt->bindValue(":LessProLastAccessed", date('Y-m-d H:i:s'));       
            $stmt->execute();
            //return "บันทึกล่ะ";
        }else{
            $sql = "UPDATE tb_lesson_progress SET LessProLastAccessed = :LessProLastAccessed WHERE EnrollmentID = :EnrollmentID AND LessonID=:LessonID";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":EnrollmentID", $rowEroll['EnrollmentID']);
            $stmt->bindValue(":LessonID", $LessonNo);
            $stmt->bindValue(":LessProLastAccessed", date('Y-m-d H:i:s'));       

            // ทำการ execute คำสั่ง SQL UPDATE
            $stmt->execute();
            //return "รอ Update";
        }

        return $rowELessonPro['LessProID'];
    }
    
}
?>
