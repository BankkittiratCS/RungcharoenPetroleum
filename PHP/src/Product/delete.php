<?php
require_once 'Product.php'; // นำเข้าไฟล์ Product.php

$product = new Product(); // สร้าง instance ของ Product

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product->delete($id); // เรียกฟังก์ชันลบผลิตภัณฑ์
}

// เปลี่ยนเส้นทางกลับไปยังหน้า index
header("Location: index.php");
exit;
?>
