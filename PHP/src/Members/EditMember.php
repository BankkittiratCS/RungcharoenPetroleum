<?php
require_once 'Member.php'; // นำเข้าไฟล์ Product.php

$member = new Members(); // สร้าง instance ของ Product

// ตรวจสอบว่ามีการส่งข้อมูล GET เพื่อแก้ไขผลิตภัณฑ์หรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $member->getAllMembers(); // ดึงข้อมูลผลิตภัณฑ์
    $row = null;

    // ค้นหาผลิตภัณฑ์ที่ตรงกับ ID
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($data['memberID'] == $id) {
            $row = $data;
            break;
        }
    }
    

    // ตรวจสอบว่ามีการส่งข้อมูล POST เพื่ออัปเดตผลิตภัณฑ์หรือไม่
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $memberID = $_POST['memberID'];
        $memberName = $_POST['memberName'];
        $memberEmail = $_POST['memberEmail'];
        $purchased = $_POST['purchased'];
        $point = $_POST['point'];
        $debt = $_POST['debt'];

        // เรียกฟังก์ชันอัปเดตผลิตภัณฑ์
        $member->updateMember($memberID, $memberName, $memberEmail, $purchased, $point, $debt);
        // เปลี่ยนเส้นทางกลับไปยังหน้า index
        header("Location: Membersindex.php");
        exit;
    }
} else {
    // ถ้าไม่มี ID ให้เปลี่ยนเส้นทางกลับไปยังหน้า index
    header("Location: Membersindex.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>

<body>
    <h1>Edit Member</h1>
    <form method="POST">
        <input type="hidden" name="memberID" value="<?php echo $row['memberID']; ?>" required>
        <input type="text" name="memberName" value="<?php echo $row['memberName']; ?>" required>
        <input type="text" name="memberEmail" value="<?php echo $row['memberEmail']; ?>" required> <!-- ให้แน่ใจว่าไม่มีอักษรพิเศษ -->
        <input type="number" name="purchased" value="<?php echo $row['purchased']; ?>" required>
        <input type="number" name="point" value="<?php echo $row['point']; ?>" required>
        <input type="number" name="debt" value="<?php echo $row['debt']; ?>" required>

        <button type="submit">Update Member</button>
    </form>
</body>

</html>