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
    <style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;500;700&display=swap');
 
:root{
    --bg: #2A2522;
    --card: #FFFFFF;
    --ink: #2A2522;
    --ink-soft: #6B6058;
    --rose: #9B5F5F;
    --rose-deep: #7E4949;
    --rose-tint: rgba(155, 95, 95, 0.08);
    --line: #F1E5E5;
    --bg-soft: #34302C;
}
 
*{ box-sizing: border-box; }
 
body{
    margin: 0;
    min-height: 100vh;
    background: var(--bg);
    background-image:
        radial-gradient(circle at 20% 20%, rgba(155, 95, 95, 0.18), transparent 45%),
        radial-gradient(circle at 80% 85%, rgba(155, 95, 95, 0.12), transparent 45%);
    font-family: 'Tajawal', sans-serif;
    color: var(--ink);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
}
 
main{ width: 100%; max-width: 380px; }
 
/* ===== restricted access badge — signature element ===== */
.access_badge{
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-bottom: 18px;
    color: rgba(255,255,255,0.55);
    font-size: 0.76rem;
    font-weight: 700;
    letter-spacing: 0.04em;
}
.access_badge i{ font-size: 0.7rem; color: var(--rose); }
 
/* ===== card ===== */
.container{
    background: var(--card);
    border-radius: 22px;
    padding: 38px 32px;
    box-shadow: 0 30px 60px rgba(0,0,0,0.35);
    border: 1px solid rgba(255,255,255,0.06);
}
 
.lock_icon{
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: var(--rose-tint);
    color: var(--rose);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    margin: 0 auto 18px;
}
 
.container h1{
    font-family: 'Cairo', sans-serif;
    font-size: 1.35rem;
    font-weight: 800;
    text-align: center;
    margin: 0 0 6px;
    color: var(--ink);
}
 
.subtitle{
    text-align: center;
    font-size: 0.85rem;
    color: var(--ink-soft);
    margin: 0 0 28px;
}
 
form{ display: flex; flex-direction: column; gap: 16px; }
 
.form-group{
    display: flex;
    flex-direction: column;
    gap: 6px;
}
 
.form-group label{
    font-size: 0.82rem;
    font-weight: 700;
    color: var(--ink);
}
 
.form-group input{
    padding: 13px 16px;
    border: 1.5px solid var(--line);
    border-radius: 12px;
    font-size: 0.92rem;
    font-family: 'Tajawal', sans-serif;
    color: var(--ink);
    background: #fff;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
 
.form-group input:focus{
    border-color: var(--rose);
    box-shadow: 0 0 0 3px var(--rose-tint);
}
 
button[type="submit"]{
    margin-top: 6px;
    width: 100%;
    background: linear-gradient(135deg, var(--rose) 0%, var(--rose-deep) 100%);
    color: #fff;
    border: none;
    padding: 14px 20px;
    font-size: 0.96rem;
    font-weight: 700;
    border-radius: 12px;
    cursor: pointer;
    font-family: 'Tajawal', sans-serif;
    box-shadow: 0 10px 22px rgba(155, 95, 95, 0.28);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
 
button[type="submit"]:hover{
    transform: translateY(-2px);
    box-shadow: 0 14px 28px rgba(155, 95, 95, 0.34);
}
 
button[type="submit"]:active{ transform: translateY(0); }
 
/* status messages printed by PHP */
p{
    font-family: 'Tajawal', sans-serif;
    font-size: 0.88rem;
    font-weight: 600;
    background: var(--card);
    border-radius: 12px;
    padding: 12px 18px;
    max-width: 380px;
    margin: 0 auto 16px;
    box-shadow: 0 10px 24px rgba(0,0,0,0.18);
}
</style>
</head>

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