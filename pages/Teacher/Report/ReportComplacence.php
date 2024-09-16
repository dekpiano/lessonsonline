<?php
include_once '../../../php/Database/Database.php'; 
require '../../../plugins/spreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

$database = new Database();
$pdo = $database->getConnection();

try {
    $questions = $pdo->query("SELECT CONCAT(tb_assessments_questions.ass_question_article,'.',tb_assessments_questions.ass_question_text) AS question_text FROM tb_assessments_questions WHERE assessment_id = 1 ORDER BY ass_question_id");
    $data_questions = $questions->fetchAll(PDO::FETCH_ASSOC);
    // ดึงข้อมูลจากฐานข้อมูล
    $stmt = $pdo->query("SELECT
        tb_users.UserPrefix,
        tb_users.UserFirstName,
        tb_users.UserLastName,
        tb_assessments_questions.ass_question_article,
        GROUP_CONCAT(tb_assessments_questions.ass_question_id) AS question_id,
        GROUP_CONCAT(CONCAT(tb_assessments_questions.ass_question_article,'.',tb_assessments_questions.ass_question_text)) AS question_text,
        GROUP_CONCAT(tb_assessments_responses.response_rating) AS response_rating,
        GROUP_CONCAT(tb_assessments_responses.response_text) AS response_text,
        tb_assessments_responses.user_id,
        tb_assessments_responses.created_at
    FROM
    tb_assessments_responses
    INNER JOIN tb_users ON tb_users.UserID = tb_assessments_responses.user_id
    INNER JOIN tb_assessments_questions ON tb_assessments_questions.ass_question_id = tb_assessments_responses.question_id
    GROUP BY tb_assessments_responses.user_id
    "); 
        // แก้ไขให้ตรงกับตารางและคอลัมน์ที่ต้องการ
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //echo '<pre>'; print_r($data_questions);
    //exit();
    // สร้าง Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();


    $sheet->getColumnDimension('A')->setWidth(20);  // วันที่ประเมิน
    $sheet->getColumnDimension('B')->setWidth(40);  // ชื่อ - นามสกุล

    // ตั้งค่า Header
    $sheet->setCellValue('A1', 'วันที่ประเมิน'); 
    $sheet->setCellValue('B1', 'ชื่อ - นามสกุล');
    $rowNumber = 1;
    foreach ($data_questions as $index => $row_questions){
        $columnLetter = Coordinate::stringFromColumnIndex($index + 3);
        $cell = $sheet->getCell("{$columnLetter}{$rowNumber}");
        $cell->setValue($row_questions['question_text']);
    }
    

    // Merge cells สำหรับหัวข้อหลัก
    //$sheet->mergeCells('A1:A2');

    // ตั้งค่าการจัดตำแหน่งข้อความให้กลาง
    //$sheet->getStyle('A1:AA2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //$sheet->getStyle('A1:AA2')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    // ตั้งค่า Border สำหรับ Header
    $sheet->getStyle('A1:AA2')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

    // เพิ่มข้อมูลจากฐานข้อมูลในแต่ละแถว
    $rowNumber = 2;
    foreach ($data as $index => $row) {
        $sheet->setCellValue('A' . $rowNumber, $row['created_at']);
        $sheet->setCellValue('B' . $rowNumber, $row['UserPrefix'].$row['UserFirstName'].' '.$row['UserLastName']);

        
        $Sub_response_text = explode(",",$row['response_text']); 
        foreach ($Sub_response_text as $key_text => $value_text) {
            if($value_text == ""){
                $Sub_response_rating = explode(",",$row['response_rating']); 
                foreach ($Sub_response_rating as $key_rating => $value_rating) {
                   $columnLetter = Coordinate::stringFromColumnIndex($key_rating + 3);
                   $sheet->setCellValue("{$columnLetter}{$rowNumber}", $value_rating);
                }
            }else{
                    $columnLetter = Coordinate::stringFromColumnIndex($key_text + 3);
                   $sheet->setCellValue("{$columnLetter}{$rowNumber}", $value_text);
                    
            }
        }

         


        
        $rowNumber++;
    }

    // กำหนดเส้นขอบให้กับช่วงข้อมูลทั้งหมด
        $lastRow = $rowNumber - 1;
        $sheet->getStyle('A1:AH' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                //'vertical' => Alignment::VERTICAL_CENTER,
                //'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => false,
            ],
        ]);

     // ตั้งค่า header เพื่อให้สามารถดาวน์โหลดไฟล์ Excel
     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
     header('Content-Disposition: attachment;filename="แบบประเมิน.xlsx"');
     header('Cache-Control: max-age=0');
 
     $writer = new Xlsx($spreadsheet);
     $writer->save('php://output');
     exit;

    // สร้างไฟล์ Excel
    // $writer = new Xlsx($spreadsheet);
    // $fileName = 'report.xlsx';
    // $writer->save($fileName);

    // echo "สร้างไฟล์รายงานสำเร็จ: " . $fileName;

} catch (PDOException $e) {
    echo 'การเชื่อมต่อฐานข้อมูลล้มเหลว: ' . $e->getMessage();
}
