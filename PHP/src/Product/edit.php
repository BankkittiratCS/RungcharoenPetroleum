<?php
require_once 'Product.php'; // นำเข้าไฟล์ Product.php

$product = new Product(); // สร้าง instance ของ Product

// ตรวจสอบว่ามีการส่งข้อมูล GET เพื่อแก้ไขผลิตภัณฑ์หรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $product->read(); // ดึงข้อมูลผลิตภัณฑ์
    $row = null;

    // ค้นหาผลิตภัณฑ์ที่ตรงกับ ID
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($data['ProductID'] == $id) {
            $row = $data;
            break;
        }
    }

    // ตรวจสอบว่ามีการส่งข้อมูล POST เพื่ออัปเดตผลิตภัณฑ์หรือไม่
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['ProductName'];
        $price = $_POST['ProductPrice'];
        $size = $_POST['ProductSize'];
        $info = $_POST['ProductInfo'];

        // เรียกฟังก์ชันอัปเดตผลิตภัณฑ์
        $product->update($id, $name, $price, $size, $info);
        // เปลี่ยนเส้นทางกลับไปยังหน้า index
        header("Location: Productindex.php");
        exit;
    }
} else {
    // ถ้าไม่มี ID ให้เปลี่ยนเส้นทางกลับไปยังหน้า index
    header("Location: index.php");
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
    <h1>Edit Product</h1>
    <form method="POST">
        <input type="text" name="ProductName" value="<?php echo $row['ProductName']; ?>" required>
        <input type="number" name="ProductPrice" value="<?php echo $row['ProductPrice']; ?>" required>
        <input type="text" name="ProductSize" value="<?php echo $row['ProductSize']; ?>" required>
        <textarea name="ProductInfo" required><?php echo $row['ProductInfo']; ?></textarea>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
