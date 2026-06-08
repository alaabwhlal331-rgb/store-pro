<?php
// بدأ الجلسة
session_start();
// حذف جميع المتغيرات من الجلسة
session_unset();
// تدمير الجلسة
session_destroy();
// إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
header("Location: admin.php"); 
?>