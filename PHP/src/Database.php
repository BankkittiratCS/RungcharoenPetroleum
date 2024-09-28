<?php
// Database.php
require_once('config.php');
class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            // สร้างการเชื่อมต่อด้วย PDO
            $this->connection = new PDO(
                "mysql:host=" . Config::DB_SERVER . ";dbname=" . Config::DB_NAME,
                Config::DB_USERNAME,
                Config::DB_PASSWORD
            );

            // ตั้งค่า PDO ให้แสดงข้อผิดพลาด
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // ตั้งค่าให้ใช้ UTF-8
            $this->connection->exec("set names utf8");

        } catch (PDOException $e) {
            throw new Exception("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        $this->connection = null;
    }

    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    public function showData(){
        $stmt = $this->connection->query("SELECT * FROM members");
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // ดึงข้อมูลทั้งหมดในรูปแบบ associative array

        if ($result) {
            foreach ($result as $row) {
                // แสดงผลข้อมูลในรูปแบบที่อ่านง่าย
                echo "<pre>" . htmlspecialchars($row, true) . "</pre>";
            }
        } else {
            echo "No results found."; // แสดงข้อความเมื่อไม่พบข้อมูล
        }
    }
}
?>
