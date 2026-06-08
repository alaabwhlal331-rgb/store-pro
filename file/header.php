<?php
// إعداد بيانات الاتصال بقاعدة البيانات
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'shopping1';

// إنشاء اتصال MySQL باستخدام mysqli
$conn = mysqli_connect($host, $username, $password, $dbname);

// التحقق من نجاح الاتصال
if ($conn) {
    echo "تم الاتصال بقاعدة البيانات بنجاح";
} else {
    echo "فشل الاتصال: " . mysqli_connect_error();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> الصفحة الرئيسية </title>
    <!-- ربط ملف التنسيق العام -->
    <link rel="stylesheet" href="./style.css">
    <!-- ربط مكتبة Bootstrap لتنسيق أسرع -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- ربط أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
  <header>
    <!-- شعار الموقع -->
<!-- start logo  -->
<div class="logo">
    <h1>Shopping</h1>
    <img src="images/logo.png" alt="Logo">
</div>

<!-- start search -->
<div class="header-actions">
  <div class="search">
    <div class="search_bar">
      <!-- نموذج البحث -->
      <form action="" method="get">
        <input type="text" placeholder="Search..." class="search_input" name="">
        <button type="submit" class="search_button" name="btn_search">Search</button>
      </form>
    </div>
  </div>

  <!-- عربة التسوق وأيقونة المستخدم -->
  <div class="cart">
    <ul>
      <li class="cart-icon"><a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
        <span class="cart-count">0</span></li>
      <li><a href="signup.php"><i class="fa-solid fa-user"></i></a></li>
    </ul>
  </div>
  <!-- end cart -->
</div>

  </header>
<!-- end header -->



  <!-- main navigation (links + social icons) -->
  <nav class="main-nav">
    <ul class="nav-links">
      <!-- روابط التنقل الأساسية -->
      <li><a href="index.html">Home</a></li>
      <li><a href="products.html">Products</a></li>
      <li><a href="about.html">About Us</a></li>
      <li><a href="contact.html">Contact Us</a></li>
    </ul>

    <ul class="social-media">
      <!-- روابط حسابات السوشيال ميديا -->
      <li><a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
      <li><a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
      <li><a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
      <li><a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
    </ul>
 
 

   <!-- start section  -->
    <div class="section">
           <ul>
<li><a href="index.php">Home</a></li>

<?php
$query = "SELECT * FROM Section1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    echo $row['Sectionname'] . " ";


?>
<Li><a href=""> <?php echo $row['Sectionname']; ?>

</a></Li>
<?php
}
?>
              </ul>
     </div>
 </nav>
<!-- end section -->
