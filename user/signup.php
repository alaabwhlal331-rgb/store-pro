<?php
// بداية الجلسة
session_start();
// ملف الاتصال بقاعدة البيانات
include ('../include/connected.php');
// التحقق من تسجيل الدخول
if(isset($_SESSION['user_id'])){
    echo "<script>alert('you are already logged in');window.location.href=''</script>";
}
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        // انشاء استعلاكم للتحقق من وجود مستخدم قام بالتسجيل في المتجر ان لا 
        $user_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $user_query);
        if (mysqli_num_rows($result) > 0) {
           echo "<script>alert('you are already logged in');</script>";
        }
        else{
            $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            $result = mysqli_query($conn, $query);
           echo "<script>alert('تم التسجيل بنجاح'); window.location.href='../index.php'</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="user-container">
        <h2>Signup</h2>
        <form action="signup.php" method="POST">
            <div class='input-signup'>
            <input type="text" name="username" placeholder="input your name" required>
            </div>
            <div class='input-signup'>
            <input type="email" name="email" placeholder="input your email" required>
            </div>
            <div class='input-signup'>
            <input type="password" name="password" placeholder="input your password" required>
            </div>
           <button type="submit" class="btn">signup</button>
        </form>
        <div class='footer'>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</body>
</html>