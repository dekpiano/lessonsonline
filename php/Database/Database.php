<?php 
session_start(); // เริ่ม session

class Database {
    private $host = "localhost";
    private $db_name = "skjacth_lessonsonline";
    private $username = "root";
    private $password = "";
    public $conn;

    // การเชื่อมต่อฐานข้อมูล
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    
}

function uri($segmentNumber, $default = null) {
   
    $currentUrl = $_SERVER['REQUEST_URI']; // ตัวอย่าง URL
    $parsedUrl = parse_url($currentUrl);
    $path = $parsedUrl['path'];
    $segments = explode('/', $path);
    $segments = array_filter($segments); // ลบ elements ว่าง
    $segments = array_values($segments); // reset keys

    // ตรวจสอบว่า segment ที่ร้องขอมีอยู่หรือไม่
    if($_SERVER['HTTP_HOST'] == 'localhost'){
        if(isset($segments[$segmentNumber - 0])) {
            return $segments[$segmentNumber - 0];
        } else {
            return $default;
        }
    }else{
        if(isset($segments[$segmentNumber - 1])) {
            return $segments[$segmentNumber - 1];
        } else {
            return $default;
        }
    }
   
}
?>