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

    // อ่านข้อมูลคอร์สเรียนทั้งหมด
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // เพิ่มคอร์สเรียนใหม่
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET CourseName=:CourseName, Description=:Description, TeacherID=:TeacherID, CourseDateCreated=:CourseDateCreated";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->CourseName=htmlspecialchars(strip_tags($this->CourseName));
        $this->Description=htmlspecialchars(strip_tags($this->Description));
        $this->TeacherID=htmlspecialchars(strip_tags($this->TeacherID));
        $this->CourseDateCreated=htmlspecialchars(strip_tags($this->CourseDateCreated));

        // bind values
        $stmt->bindParam(":CourseName", $this->CourseName);
        $stmt->bindParam(":Description", $this->Description);
        $stmt->bindParam(":TeacherID", $this->TeacherID);
        $stmt->bindParam(":CourseDateCreated", $this->CourseDateCreated);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
