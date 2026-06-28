<?php
session_start();
// ملف الاتصال بقاعدة البيانات
include ('../include/connected.php');
if(isset($_SESSION['user_id'])){
    echo "<script>alert('you are already logged in');window.location.href='../index.php'</script>";
}
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $user_query);
        if (mysqli_num_rows($result) > 0) {
           $user_data=mysqli_fetch_assoc($result);
           $_SESSION['user_id']=$user_data['id'];
           echo "<script>alert('تم التسجيل بنجاح'); window.location.href='../index.php'</script>";
        }
        else{
            echo '<script>alert("اسم المستخدم او كلمة المرور غير صحيحة");</script>';
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
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class='input-signup'>
            <input type="text" name="username" placeholder="input your name" required>
            </div>
            <div class='input-signup'>
            <input type="password" name="password" placeholder="input your password" required>
            </div>
           <button type="submit" class="btn">Login</button>
        </form>
        <div class='footer'>
            <p>you don't have an account? <a href="signup.php">signup</a></p>
        </div>
    </div>
</body>
</html>