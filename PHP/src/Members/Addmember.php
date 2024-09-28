<?php
require_once "Member.php";
$member = new Members();
try{
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberName = $_POST["Membername"];
    $ฺmemberEmail = $_POST["ฺmemberEmail"];
    $member->addMember($memberName, $ฺmemberEmail);
}
}catch(PDOException $e){
    echo "Error: ". $e->getMessage();
    header("Location: Membersindex.php"); 
    die();  // หยุดการทำงานทันทีเมื่อพบข้อ��ิดพลา��
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <form method="POST">
    <input type="text" name="Membername" placeholder="ชื่อสมาชิก" required>
    <input type="text" name="ฺmemberEmail" placeholder="อีเมลสมาชิก" required>
    <button type="submit">เพิ่มสมาชิก</button>
 </form>
</body>
</html>