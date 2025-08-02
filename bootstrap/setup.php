<?php
// إعدادات الاتصال بالسيرفر
$servername = "localhost";
$username = "root";
$password = ""; // عدّل حسب بياناتك

// اسم قاعدة البيانات
$dbname = "pdfbooks";

try {
    // إنشاء اتصال جديد بدون قاعدة بيانات محددة
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // إنشاء قاعدة البيانات إذا لم تكن موجودة
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    $conn->exec($sql);
    echo "قاعدة البيانات '$dbname' تم إنشاؤها أو موجودة مسبقاً.<br>";

    // استخدام قاعدة البيانات الجديدة
    $conn->exec("USE $dbname");

    // إنشاء جدول admin
    $sqlAdmin = "CREATE TABLE IF NOT EXISTS admin (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        adminName VARCHAR(255) NOT NULL,
        adminEmail VARCHAR(255) NOT NULL UNIQUE,
        adminPass VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $conn->exec($sqlAdmin);
    echo "جدول 'admin' تم إنشاؤه أو موجود مسبقاً.<br>";

    // إنشاء جدول books
    $sqlBooks = "CREATE TABLE IF NOT EXISTS books (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        bookCover VARCHAR(255),
        bookAuthor VARCHAR(255),
        bookContent TEXT,
        bookTitle VARCHAR(255),
        bookCat INT(11),
        book VARCHAR(255)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $conn->exec($sqlBooks);
    echo "جدول 'books' تم إنشاؤه أو موجود مسبقاً.<br>";

    // إنشاء جدول categories
    $sqlCategories = "CREATE TABLE IF NOT EXISTS categories (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        categoryName VARCHAR(255) NOT NULL,
        categoryDate DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

    $conn->exec($sqlCategories);
    echo "جدول 'categories' تم إنشاؤه أو موجود مسبقاً.<br>";

    echo "<br>تم الانتهاء من إعداد قاعدة البيانات '$dbname' بنجاح.";

} catch(PDOException $e) {
    echo "خطأ في إنشاء قاعدة البيانات أو الجداول: " . $e->getMessage();
}
?>
