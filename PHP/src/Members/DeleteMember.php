<?php
require_once 'Member.php'; // นำเข้าไฟล์ Product.php

$member = new Members(); // สร้าง instance ของ Product

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $member->DeleteMember($id); // เรียกฟังก์ชันลบผลิตภัณฑ์
}

// เปลี่ยนเส้นทางกลับไปยังหน้า index
header("Location: Membersindex.php");
exit;
?>
