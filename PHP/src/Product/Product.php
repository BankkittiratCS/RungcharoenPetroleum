<?php
require_once '../Database.php';

class Product {
    private $connection; // ตัวแปรสำหรับเก็บการเชื่อมต่อ
    private $table_name = "Product"; // ชื่อของตาราง

    public function __construct() {
        $database = new Database(); // สร้าง instance ของ Database
        $this->connection = $database->getConnection(); // รับการเชื่อมต่อ
    }

    // ฟังก์ชันสร้างผลิตภัณฑ์
    public function create($ID,$name, $price, $size, $info) {
        $query = "INSERT INTO " . $this->table_name . "(ProductID,ProductName, ProductPrice, ProductSize, ProductInfo) VALUES (:ID,:name, :price, :size, :info)";
        $stmt = $this->connection->prepare($query); // เตรียมคำสั่ง SQL

        // ตั้งค่าพารามิเตอร์
        $stmt->bindParam(':ID', $ID);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':info', $info);

        // รันคำสั่ง SQL และส่งคืนผลลัพธ์
        return $stmt->execute();
    }

    // ฟังก์ชันดึงข้อมูลผลิตภัณฑ์ทั้งหมด
    public function read() {
        $query = "SELECT * FROM " . $this->table_name; // คำสั่ง SQL
        $stmt = $this->connection->prepare($query); // เตรียมคำสั่ง SQL
        $stmt->execute(); // รันคำสั่ง

        return $stmt; // ส่งคืนผลลัพธ์
    }

    // ฟังก์ชันอัปเดตผลิตภัณฑ์
    public function update($id, $name, $price, $size, $info) {
        $query = "UPDATE " . $this->table_name . " SET ProductName = :name, ProductPrice = :price, ProductSize = :size, ProductInfo = :info WHERE ProductID = :id";
        $stmt = $this->connection->prepare($query); // เตรียมคำสั่ง SQL

        // ตั้งค่าพารามิเตอร์
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':info', $info);

        // รันคำสั่ง SQL และส่งคืนผลลัพธ์
        return $stmt->execute();
    }

    // ฟังก์ชันลบผลิตภัณฑ์
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE ProductID = :id"; // คำสั่ง SQL
        $stmt = $this->connection->prepare($query); // เตรียมคำสั่ง SQL
        $stmt->bindParam(':id', $id); // ตั้งค่าพารามิเตอร์

        return $stmt->execute(); // รันคำสั่ง SQL และส่งคืนผลลัพธ์
    }
}

