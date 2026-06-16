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

$DELETE='DELETE FROM section1  WHERE id=1';
mysqli_query($conn,$DELETE);



// $insert='insert into section1  values (1,"ahmed")';
// mysqli_query($conn,$insert);





  ?>
