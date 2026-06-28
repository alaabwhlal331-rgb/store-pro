<?php
session_start();
include ('../include/connected.php');
if(isset($_SESSION['user_id'])){
    session_unset();
    session_destroy();
    echo "<script>alert('تم تسجيل الخروج بنجاح');window.location.href='login.php'</script>";
}else{
    echo "<script>alert('لم تفم تسجيل الدخول  ');window.location.href='login.php'</script>";
}
?>