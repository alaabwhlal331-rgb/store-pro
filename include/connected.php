<?php
// معلومات الاتصال بقاعدة البيانات
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shopping1';

// إنشاء اتصال mysqli إلى قاعدة البيانات
$conn = mysqli_connect($host, $username, $password, $dbname);

// التحقق من نجاح الاتصال
if ($conn) {
    echo "تم الاتصال بقاعدة البيانات بنجاح";
} else {
    // إذا فشل الاتصال، نطبع سبب الخطأ
    echo "فشل الاتصال: " . mysqli_connect_error();
}