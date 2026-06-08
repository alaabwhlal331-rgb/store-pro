<?php
// بدء جلسة PHP لحفظ حالة تسجيل الدخول بين الصفحات
session_start();

// استدعاء ملف الاتصال بقاعدة البيانات
include ('../include/connected.php');

// لا نعرض HTML قبل انتهاء معالجة تسجيل الدخول حتى لا يؤثر ذلك على إعادة التوجيه
?> 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول </title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="email"],
    input[type="text"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<body>
    <main>
        <?php
        // قراءة بيانات النموذج عند الضغط على زر تسجيل الدخول
        @$ADemail = $_POST['email'];
        @$ADpassword = $_POST['password'];
        @$ADadd = $_POST['add'];

        // إذا تم الضغط على زر الإرسال، نتحقق من بيانات الدخول
        if (isset($ADadd)) {
            // استعلام للتحقق من وجود المدير في قاعدة البيانات
            $query = "SELECT * FROM `admin` WHERE `email`='$ADemail' AND `password`='$ADpassword'";
            $result = mysqli_query($conn, $query);

            // إذا وجدنا صفًا مطابقًا، يعتبر تسجيل الدخول ناجحًا
            if (mysqli_num_rows($result) > 0) {
                // تخزين البريد الإلكتروني في الجلسة لاستخدامه في الصفحات المحمية
                $_SESSION['EMAIL'] = $ADemail;
                echo "<p style='color: green; text-align: center;'>تم تسجيل الدخول بنجاح. سيتم إعادة توجيهك إلى لوحة التحكم...</p>";
                header("REFRESH:2;URL=adminpanel.php");
               
            } else {
                // إذا لم تكن البيانات صحيحة، نعرض رسالة خطأ ثم نعيد التوجيه إلى صفحة الدخول
                echo "<p style='color: red; text-align: center;'>البريد الإلكتروني أو كلمة المرور غير صحيحة.</p>";
                header("REFRESH:2;URL=index.php");
            }
        }
        ?>
        <div class="container">
            <h1>تسجيل الدخول </h1>
            <form action="admin.php" method="post">
                <div class="form-group">
                    <label for="email">البريد الإلكتروني:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور:</label>
                    <input type="text" id="password" name="password" required>
                </div>
                <br>
                <button type="submit" name='add'>تسجيل الدخول</button>
            </form>
        </div>
    </main>


</body>
</html>