<?php
class ClassLogin {
    private $conn;
    private $table_name = "tb_users";

    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function LoginAdmin() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE Username = :Username";

        $stmt = $this->conn->prepare($query);

        $this->username=htmlspecialchars(strip_tags($this->username));

        $stmt->bindParam(":Username", $this->username);

        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($this->password, $row['Password'])) {
                return true;
            }
        }
        return false;
    }
}
?>