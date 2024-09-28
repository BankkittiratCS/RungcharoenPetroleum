<?php
require_once 'Product.php'; // นำเข้าไฟล์ Product.php

$product = new Product(); // สร้าง instance ของ Product

//ตรวจสอบว่ามีการส่งข้อมูล POST เพื่อสร้างผลิตภัณฑ์หรือไม่
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $name = $_POST['ProductName'];
    $price = $_POST['ProductPrice'];
    $size = $_POST['ProductSize'];
    $info = $_POST['ProductInfo'];

    // เรียกฟังก์ชันสร้างผลิตภัณฑ์
    $product->create($name, $price, $size, $info);
}

// ดึงข้อมูลผลิตภัณฑ์
$product = $product->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
</head>
<body>
    <h1>Product Management</h1>

    <h2>Add Product</h2>
    <form method="POST">
    
        <input type="text" name="ProductName" placeholder="Product Name" required>
        <input type="number" name="ProductPrice" placeholder="Product Price" required>
        <input type="text" name="ProductSize" placeholder="Product Size" required>
        <textarea name="ProductInfo" placeholder="Product Info" required></textarea>
        <button type="submit">Add Product</button>
    </form>

    <h2>Product List</h2>
    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Size</th>
            <th>Product Info</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $product->fetch(PDO::FETCH_ASSOC)) { ?>
        <tr>
            <td><?php echo $row['ProductID']; ?></td>
            <td><?php echo $row['ProductName']; ?></td>
            <td><?php echo $row['ProductPrice']; ?></td>
            <td><?php echo $row['ProductSize']; ?></td>
            <td><?php echo $row['ProductInfo']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['ProductID']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['ProductID']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
