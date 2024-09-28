<?php
require_once '../Database.php';
class Members
{
    private $connection;
    private $memberID;
    private $memberName;
    private $purchased;
    private $point;
    private $debt;
    private $memberEmail;
    private $tablename = "members";
    public function __construct()
    {
        $database = new Database();
        $this->connection = $database->getConnection();
    }

    public function getAllMembers()
    {
        $query = "SELECT * FROM members";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function Addmember($memberName, $memberEmail): void
    {
        $query = "INSERT INTO " . $this->tablename . " (memberName, memberEmail, purchased, point, debt) 
              VALUES (:memberName, :memberEmail, :purchased, :point, :debt)";

        // เตรียมคำสั่ง SQL
        $stmt = $this->connection->prepare($query);

        // bindParam สำหรับพารามิเตอร์ที่เป็น input จากผู้ใช้
        $stmt->bindParam(':memberName', $memberName);
        $stmt->bindParam(':memberEmail', $memberEmail);

        // bindValue สำหรับค่าคงที่
        $stmt->bindValue(':purchased', 0);
        $stmt->bindValue(':point', 0);
        $stmt->bindValue(':debt', 0);

        // รันคำสั่ง SQL
        $stmt->execute();
    }
    public function DeleteMember($id): void
    {
        $query = "DELETE FROM " . $this->tablename . " WHERE memberID = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    public function updateMember($memberID, $memberName, $memberEmail, $purchased, $point, $debt)
    {
        try {
            
            $query = "UPDATE " . $this->tablename . " SET memberName = :memberName, memberEmail = :memberEmail, purchased = :purchased, point = :point, debt = :debt WHERE memberID = :id";
            $stmt = $this->connection->prepare($query);

            // bind parameters
            $stmt->bindParam(':memberName', $memberName);
            $stmt->bindParam(':memberEmail', $memberEmail);
            $stmt->bindValue(':purchased', $purchased);
            $stmt->bindValue(':point', $point);
            $stmt->bindValue(':debt', $debt);
            $stmt->bindValue(':id', $memberID); // ensure memberID is bound correctly

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
