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


        $query = "SELECT
            tb_questions.QuestionLessonID,
            tb_questions.QuestionText,
            tb_questions.QuestionID,
            GROUP_CONCAT(OptChoice) AS OptChoiceArray,
            GROUP_CONCAT(OptAnswer) AS OptAnswerArray
            FROM
            tb_questions
            INNER JOIN tb_options ON tb_questions.QuestionID = tb_options.OptQuestionID
            WHERE
            tb_questions.QuestionLessonID = ?
            GROUP BY
            tb_options.OptQuestionID
            ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1,$LeesonID['LessonID']);
        $stmt->execute();
        return $stmt;
    }


    public function CheckAnswersUser($Answers) {
       
        $Sum = 0;
        foreach ($Answers['QuestionID'] as $key => $value) {            
            $query = "SELECT OptAnswer FROM tb_options WHERE OptQuestionID = ? AND OptChoice = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $value);
            $stmt->bindValue(2, $Answers['OptChoice'.$value]);
            $stmt->execute();
            while ($re = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $Sum += $re['OptAnswer'];
                $queryInsert = "INSERT INTO tb_useranswers (QuestionID,UserID,UserAnswerGiven,UserAnswerIsCorrect,UserAnswerCategory) VALUE (?,?,?,?,?)";
                $stmtInsert = $this->conn->prepare($queryInsert);
                $stmtInsert->bindValue(1, $value);
                $stmtInsert->bindValue(2, $_SESSION['UserID']); 
                $stmtInsert->bindValue(3, $Answers['OptChoice'.$value]);
                $stmtInsert->bindValue(4, $re['OptAnswer']);
                $stmtInsert->bindValue(5, $_POST['UserAnswerCategory']);
                $stmtInsert->execute(); 
            }
            
        }
        return $Sum;
        //print_r($Answers['OptChoice1']);
      
        exit();
        
    }

    public function Viewscore($LessonID){
        $query = "SELECT
                    COUNT(tb_questions.QuestionLessonID) AS CountAll,
                    COUNT(CASE WHEN UserAnswerIsCorrect = 1 THEN 1 END) AS SumScore
                    FROM tb_useranswers
                    INNER JOIN tb_questions ON tb_useranswers.QuestionID = tb_questions.QuestionID
                    WHERE
                    tb_questions.QuestionLessonID = ? AND tb_useranswers.UserID = ?
                    ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $LessonID);
        $stmt->bindValue(2, $_SESSION['UserID']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function ViewAnswerIsCorrect($LessonID){
        $query = "SELECT
        tb_useranswers.UserAnswerIsCorrect,
        tb_useranswers.QuestionID,        
        tb_useranswers.UserAnswerGiven
        FROM
        tb_useranswers
        INNER JOIN tb_questions ON tb_useranswers.QuestionID = tb_questions.QuestionID
        INNER JOIN tb_options ON tb_useranswers.QuestionID = tb_options.OptQuestionID
        WHERE
        tb_questions.QuestionLessonID = ? AND tb_useranswers.UserID = ?
        GROUP BY
        tb_questions.QuestionID
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $LessonID);
        $stmt->bindValue(2, $_SESSION['UserID']);
        $stmt->execute();
        $AnswerIsCorrect = [];
        $AnswerGiven = [];
        $data = [];
        $i=0;
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[$row['QuestionID']][] = $row['UserAnswerGiven'];
            $data[$row['QuestionID']][] = $row['UserAnswerIsCorrect'];           
            $i++;
         }
        return $data;
    }
    
}


?>
