<?php
date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า Time Zone ตามที่ต้องการ

class Course {
    private $conn;
    private $table_name = "tb_courses";

    public $TitleBar = "คอร์สเรียน";
    public $CourseID;
    public $CourseName;
    public $CourseDescription;
    public $TeacherID;
    public $CourseDateCreated;

    public function __construct($db) {
        $this->conn = $db;
       
        if(empty($_SESSION['UserID'])){
            header("Location: ../../../");
            exit();
        }
    }

    public function getNewCourseCode() {
        $query = "SELECT CourseCode FROM " . $this->table_name . " ORDER BY CourseCode DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        $lastCode = $stmt->fetchColumn();
        
        if ($lastCode) {
            $number = str_replace("Course_", "", $lastCode); // ลบส่วนของข้อความ "Con_" ออก
            $newNumber = str_pad((int)$number + 1, 4, "0", STR_PAD_LEFT); // แปลงเป็นตัวเลข, เพิ่มค่าขึ้น 1, แล้วเติม 0 ให้ครบ 3 หลัก
            $newCode = "Course_" . $newNumber;
        } else {
            // หากไม่มีรหัสใดๆ ในฐานข้อมูล
            $newCode = "Course_0001";
        }
        
        return $newCode;
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
    }

    // เพิ่มคอร์สเรียนใหม่
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET CourseCode=:CourseCode,CourseName=:CourseName, CourseDescription=:CourseDescription, CourseDateCreated=:CourseDateCreated,TeacherID=:TeacherID";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->CourseCode=htmlspecialchars(strip_tags($this->CourseCode));
        $this->CourseName=htmlspecialchars(strip_tags($this->CourseName));
        $this->CourseDescription=htmlspecialchars(strip_tags($this->CourseDescription));
        $this->CourseDateCreated=htmlspecialchars(strip_tags($this->CourseDateCreated));
        $this->TeacherID=htmlspecialchars(strip_tags($this->TeacherID));

        // bind values
        $stmt->bindParam(":CourseCode", $this->CourseCode);
        $stmt->bindParam(":CourseName", $this->CourseName);
        $stmt->bindParam(":CourseDescription", $this->CourseDescription);
        $stmt->bindParam(":CourseDateCreated", $this->CourseDateCreated);
        $stmt->bindParam(":TeacherID", $this->TeacherID);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function UpdateCourse() {
        $query = "UPDATE " . $this->table_name . "
                  SET CourseName = :CourseName, CourseDescription = :CourseDescription
                  WHERE CourseCode = :CourseCode ";

        $stmt = $this->conn->prepare($query);

                  // ทำความสะอาดข้อมูล
        $this->CourseName=htmlspecialchars(strip_tags($this->CourseName));
        $this->CourseDescription=htmlspecialchars(strip_tags($this->CourseDescription));
        $this->CourseCode=htmlspecialchars(strip_tags($this->CourseCode));

        // ผูกค่า
        $stmt->bindParam(':CourseName', $this->CourseName);
        $stmt->bindParam(':CourseDescription', $this->CourseDescription);
        $stmt->bindParam(':CourseCode', $this->CourseCode);

        // ประมวลผลคำสั่ง
        if($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
