<?php
class ClassQuizzesUser {
    private $conn;
    private $table_name = "tb_questions";

    public $TitleBar = "แบบทดสอบ";

    public function __construct($db) {
        $this->conn = $db;
    }

     // อ่านข้อมูลสมัครเรียนทั้งหมด
    public function readQuiz($CourseID,$LeesonNo) {

        $CheckLesson = "SELECT LessonID FROM tb_lessons WHERE CourseID = ? AND LessonNo = ?";
        $reCheckLesson = $this->conn->prepare($CheckLesson);
        $reCheckLesson->bindValue(1,$CourseID);
        $reCheckLesson->bindValue(2,$LeesonNo);
        $reCheckLesson->execute();
        $LeesonID = $reCheckLesson->fetch(PDO::FETCH_ASSOC);


        $query = "SELECT * FROM tb_questions WHERE QuestionLessonID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$LeesonID['LessonID']);
        $stmt->execute();
        return $stmt;
    }


    public function CheckEmail($email) {
        $query = "SELECT COUNT(*) FROM ".$this->table_name." WHERE Email = :Email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":Email", $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    
        return $count > 0 ? true : false;
    }


    
}


?>
