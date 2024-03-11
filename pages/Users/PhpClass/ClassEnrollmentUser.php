<?php
date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า Time Zone ตามที่ต้องการ

class ClassEnrollmentUser {
    private $conn;
    private $table_name = "tb_enrollments";

    public $TitleBar = "ลงทะเบียนเรียน";

    public function __construct($db) {
        $this->conn = $db;

        // if(empty($_SESSION['UserID']) && @!$_SESSION['UserType'] == "student"){
        //     header("Location: ../../../");
        //     exit();
        // }
    }

        // เพิ่มสมัครเรียนใหม่
        public function EnrollmentUserInsert() {

            $data = array('CourseID','UserID','EnrollDate');
            $ASum = array();
            foreach ($data as $key => $v_data) {
                $ASum[] = $v_data."=:".$v_data;
            }
            $sub = implode(',',$ASum);
            
            $query = "INSERT INTO " . $this->table_name . " SET ". $sub;
    
            $stmt = $this->conn->prepare($query);
    
            foreach ($data as $key => $v_data) {      
                // $this->$v_data=htmlspecialchars(strip_tags($this->$v_data));      
                 $stmt->bindParam(":".$v_data, $this->$v_data);
             }  
    
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        }

        public function CheckEnrollmentUser(){    

            $query = "SELECT * FROM " . $this->table_name . " WHERE CourseID = ? AND UserID = ?";
            $stmt = $this->conn->prepare($query);
             // ผูกค่าพารามิเตอร์
            $stmt->bindParam(1, $this->CourseID);
            $stmt->bindParam(2, $this->UserID);
            $stmt->execute();
            return $stmt->fetchColumn();
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

    
}
?>
