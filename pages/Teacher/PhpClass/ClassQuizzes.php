<?php
date_default_timezone_set('Asia/Bangkok'); // ตั้งค่า Time Zone ตามที่ต้องการ

class ClassQuizzes {
    private $conn;
    private $table_name = "tb_questions";

    public function __construct($db) {
        $this->conn = $db;
       
        if(empty($_SESSION['UserID']) && !$_SESSION['UserType'] == "teacher"){
            header("Location: ../../../");
            exit();
        }
    }

    public function CheckNameLesson($LessonID) {
        $query = "SELECT LessonTitle FROM tb_lessons WHERE LessonID = ?";

        $stmt = $this->conn->prepare($query);

        // ผูกค่าพารามิเตอร์
        $stmt->bindValue(1, $LessonID);

        $stmt->execute();
        return $stmt;
    }


    // อ่านข้อมูลบทเรียนทั้งหมด
    public function readAll($LessonID) {
        $query = "SELECT * FROM tb_questions WHERE QuestionLessonID = ?";

        $stmt = $this->conn->prepare($query);

        // ผูกค่าพารามิเตอร์
        $stmt->bindValue(1, $LessonID);

        $stmt->execute();
        return $stmt;
    }

    public function CorrectAnswer($QuestionID){

        $query = "SELECT OptChoice FROM tb_options WHERE OptQuestionID = ? AND OptAnswer = 1";

        $stmt = $this->conn->prepare($query);

        // ผูกค่าพารามิเตอร์
        $stmt->bindValue(1, $QuestionID);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    
    public function readLessonEdit() {
        $query = "SELECT tb_lessons.*,tb_courses.CourseName FROM " . $this->table_name . " 
        JOIN tb_courses ON tb_courses.CourseID = tb_lessons.CourseID
        WHERE LessonID = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        // ผูกค่าพารามิเตอร์
        $stmt->bindParam(1, $this->LessonID);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //print_r($row);
        // กำหนดค่าให้กับ properties
        $this->CourseID = $row['CourseID'];
        $this->CourseName = $row['CourseName'];
        $this->LessonCode = $row['LessonCode'];
        $this->LessonTitle = $row['LessonTitle'];
        $this->LessonNo = $row['LessonNo'];
        $this->LessonContent = $row['LessonContent'];
        $this->LessonVideoURL = $row['LessonVideoURL'];
    }

    // เพิ่มบทเรียนใหม่
    public function QuizzesPhpInsert() {
        try {
        $OptChoice = $_POST['OptChoice'] ?? []; // รับค่า options จากฟอร์ม
        $OptAnswer = $_POST['OptAnswer'] ?? []; // รับค่า correct_options จากฟอร์ม

        // foreach ($OptChoice as $key => $OptChoice) {
        //     // ตรวจสอบว่า correct_options ที่ส่งมามี index ตรงกับ options ที่กำลังตรวจสอบหรือไม่
        //     // ถ้ามีให้กำหนดค่าให้กับ $correct_value ในแต่ละรอบ
        //     $correct_value = in_array('off', $OptAnswer) ? 1 : 0;
            
        //     // สามารถใช้ตัวแปร $correct_value ในการทำอะไรก็ได้ต่อจากนั้น
        //     // เช่น บันทึกลงฐานข้อมูล หรือประมวลผลต่อไป
        //     echo "Option: $OptChoice, Correct: $correct_value <br>";
        // }

   
        $query = "INSERT INTO tb_questions (QuestionLessonID,QuestionText) VALUES (?,?)";

        $stmt = $this->conn->prepare($query);       
        $stmt->bindValue(1, $_POST['LessonID']);
        $stmt->bindValue(2, $_POST['QuestionText']);
        $stmt->execute();

        $question_id = $this->conn->lastInsertId();
       
        foreach ($OptChoice  as $key => $v_OptChoice) {
            $Choice = "INSERT INTO tb_options (OptQuestionID,OptChoice,OptAnswer) VALUES (?,?,?)";

            $stmtChoice = $this->conn->prepare($Choice);       
            $stmtChoice->bindValue(1,$question_id);
            $stmtChoice->bindValue(2, $v_OptChoice);
            $stmtChoice->bindValue(3, $OptAnswer[$key]);
            $stmtChoice->execute();
        }
        echo 1;
       
    } catch (PDOException $e) {
        die("เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $e->getMessage());
    }

    
       // print_r($_POST); 
        exit();
    }

    public function QuizzesPhpUpdate() {

        // print_r($_POST);
        // exit();
        $queryQuestions = "UPDATE tb_questions SET QuestionText = ? WHERE QuestionID = ?";
        $stmtQuestions = $this->conn->prepare($queryQuestions);
        $stmtQuestions->bindValue(1,$_POST['UpdateQuestionText']);
        $stmtQuestions->bindValue(2,$_POST['UpdateQuestionID']);
        $stmtQuestions->execute();

        $SelIDOption = "SELECT OptID FROM tb_options WHERE OptQuestionID = ?";
        $stmtIDOption = $this->conn->prepare($SelIDOption);
        $stmtIDOption->bindValue(1,$_POST['UpdateQuestionID']);
        $stmtIDOption->execute();
        $i = 0;
        while ($rowIDOption = $stmtIDOption->fetch(PDO::FETCH_ASSOC)) {            
            $query = "UPDATE tb_options SET OptChoice = ?, OptAnswer = ? WHERE OptID = ?";
            $stmtUpdateData = $this->conn->prepare($query);
            $stmtUpdateData->bindValue(1,$_POST['UpdateOptChoice'][$i]);
            $stmtUpdateData->bindValue(2,$_POST['UpdateOptAnswer'][$i]);
            $stmtUpdateData->bindValue(3,$rowIDOption['OptID']);
            $stmtUpdateData->execute();
            $i++;
        }
        
        if(!empty($_POST['OptChoice'])){
            foreach ($_POST['OptChoice']  as $key => $v_OptChoice) {
                $Choice = "INSERT INTO tb_options (OptQuestionID,OptChoice,OptAnswer) VALUES (?,?,?)";    
                $stmtChoice = $this->conn->prepare($Choice);       
                $stmtChoice->bindValue(1,$_POST['UpdateQuestionID']);
                $stmtChoice->bindValue(2, $v_OptChoice);
                $stmtChoice->bindValue(3, $_POST['OptAnswer'][$key]);
                $stmtChoice->execute();
            }
        }
        return 1;
    }

    public function UpdateLesson() {
        $query = "UPDATE " . $this->table_name . "
                  SET LessonNo=:LessonNo,LessonTitle=:LessonTitle,LessonContent=:LessonContent,LessonVideoURL=:LessonVideoURL,LessonStudyTime=:LessonStudyTime
                  WHERE LessonCode = :LessonCode";

        $stmt = $this->conn->prepare($query);

        $data = array('LessonCode','LessonNo','LessonTitle','LessonContent','LessonVideoURL','LessonStudyTime');
        // sanitize
        foreach ($data as $key => $v_data) {      
           // $this->$v_data=htmlspecialchars(strip_tags($this->$v_data));      
            $stmt->bindParam(":".$v_data, $this->$v_data);
        }   

        // ประมวลผลคำสั่ง LessonCode=:LessonCode,
        if($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function EditQuizzes($IDQuestion){
        $sqlquestions = "SELECT
        tb_options.OptChoice,
        tb_options.OptAnswer,
        tb_questions.QuestionText,
        tb_questions.QuestionID,
        tb_options.OptID
        FROM
        tb_questions
        INNER JOIN tb_options ON tb_questions.QuestionID = tb_options.OptQuestionID
         WHERE QuestionID = :QuestionID";
        $stmtquestions = $this->conn->prepare($sqlquestions);
        $stmtquestions->bindValue(':QuestionID', $IDQuestion);
        $stmtquestions->execute();
        $result =array();
        while ($row = $stmtquestions->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }

        echo json_encode($result);
    }

    public function DeleteQuizzes($delete_id){
        $sql = "DELETE FROM tb_questions WHERE QuestionID = :QuestionID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':QuestionID', $delete_id);
        $stmt->execute();

        // ตรวจสอบว่าลบข้อมูลสำเร็จหรือไม่
        if ($stmt->rowCount() > 0) {
            $sqlOpt = "DELETE FROM tb_options WHERE OptQuestionID = :OptQuestionID";
            $stmtOpt = $this->conn->prepare($sqlOpt);
            $stmtOpt->bindValue(':OptQuestionID', $delete_id);
            $stmtOpt->execute();
            return $delete_id;
        } else {
            return 0;
        }
    }

}


?>