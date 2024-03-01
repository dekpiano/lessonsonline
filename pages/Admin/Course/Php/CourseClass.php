<?php
class Course {
    private $conn;
    private $table_name = "tb_courses";

    public $TitleBar = "คอร์สเรียน";
    public $CourseID;
    public $CourseName;
    public $Description;
    public $TeacherID;
    public $CourseDateCreated;

    public function __construct($db) {
        $this->conn = $db;
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
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // เพิ่มคอร์สเรียนใหม่
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET CourseCode=:CourseCode,CourseName=:CourseName, CourseDescription=:CourseDescription, CourseDateCreated=:CourseDateCreated";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->CourseCode=htmlspecialchars(strip_tags($this->CourseCode));
        $this->CourseName=htmlspecialchars(strip_tags($this->CourseName));
        $this->CourseDescription=htmlspecialchars(strip_tags($this->CourseDescription));
        $this->CourseDateCreated=htmlspecialchars(strip_tags($this->CourseDateCreated));

        // bind values
        $stmt->bindParam(":CourseCode", $this->CourseCode);
        $stmt->bindParam(":CourseName", $this->CourseName);
        $stmt->bindParam(":CourseDescription", $this->CourseDescription);
        $stmt->bindParam(":CourseDateCreated", $this->CourseDateCreated);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
