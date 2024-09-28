<?php
// index.php
require_once 'config.php'; // นำเข้าไฟล์ config.php เพื่อใช้ค่าคอนฟิก
require_once 'Database.php'; // นำเข้าไฟล์ Database.php เพื่อใช้คลาส Database

try {
    $db = new Database(); // สร้าง instance ของ Database

    // ทดสอบการเชื่อมต่อ
    $connection = $db->getConnection(); // รับการเชื่อมต่อจากคลาส Database
    echo "Database connection successful!"; // แสดงข้อความเมื่อเชื่อมต่อสำเร็จ

    // ตัวอย่างการใช้ Prepared Statements
    $stmt = $db->prepare("SELECT * FROM members"); // เปลี่ยนเป็นชื่อของตารางที่ต้องการดึงข้อมูล
    $stmt->execute(); // รันคำสั่ง SQL

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // ดึงข้อมูลทั้งหมดในรูปแบบ associative array

    // แสดงข้อมูลในรูปแบบตาราง
    if ($result) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>"; // เริ่มตาราง
        echo "<thead>"; // ส่วนหัวของตาราง
        echo "<tr>"; // แถวหัว
        foreach ($result[0] as $key => $value) {
            echo "<th>" . htmlspecialchars($key) . "</th>"; // แสดงชื่อคอลัมน์
        }
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>"; // ส่วนของเนื้อหาตาราง
        foreach ($result as $row) {
            echo "<tr>"; // เริ่มแถวใหม่สำหรับแต่ละแถวข้อมูล
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>"; // แสดงข้อมูลในแต่ละเซลล์
            }
            echo "</tr>"; // ปิดแถว
        }
        echo "</tbody>";
        echo "</table>"; // ปิดตาราง
    } else {
        echo "No results found."; // แสดงข้อความเมื่อไม่พบข้อมูล
    }

    $db->closeConnection(); // ปิดการเชื่อมต่อฐานข้อมูล
} catch (Exception $e) {
    // แสดงข้อความข้อผิดพลาดหากเกิดข้อผิดพลาด
    echo "Error: " . $e->getMessage();
}
?>
