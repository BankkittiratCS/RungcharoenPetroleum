<?php

require_once __DIR__ . '/vendor/autoload.php'; // ให้แน่ใจว่า autoload ของ Composer ถูกโหลด

use Dotenv\Dotenv;
use PDO;
use PDOException;
echo getenv('DB_SERVER'); // ตรวจสอบค่า DB_SERVER
echo getenv('DB_NAME');    // ตรวจสอบค่า DB_NAME
echo getenv('DB_USERNAME'); // ตรวจสอบค่า DB_USERNAME
echo getenv('DB_PASSWORD'); // ตรวจสอบค่า DB_PASSWORD
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Page</title>
</head>
<body>
    <h1>Hello, World!</h1>
</body>
</html>
