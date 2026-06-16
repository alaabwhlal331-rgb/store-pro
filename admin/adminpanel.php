<?php
session_start();
include ('../include/connected.php');

// تأكد من تسجيل الدخول قبل أي إخراج
if (!isset($_SESSION['EMAIL'])) {
  header('Location: index.php');
  exit();
}

// معالجة POST قبل إخراج أي HTML (POST-Redirect-GET)
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['secadd'])) {
  $Sectionname = trim($_POST['Sectionname'] ?? '');

  if ($Sectionname === '') {
    $_SESSION['message'] = "<p style='color: red; text-align: center;'>يرجى إدخال اسم القسم.</p>";
  } elseif (mb_strlen($Sectionname) > 50) {
    $_SESSION['message'] = "<p style='color: red; text-align: center;'>اسم القسم لا يجب أن يتجاوز 50 حرفًا.</p>";
  } else {
    $SectionnameEscaped = mysqli_real_escape_string($conn, $Sectionname);
    // تحقق من تكرار الاسم
    $checkSql = "SELECT COUNT(*) AS cnt FROM section1 WHERE Sectionname = '$SectionnameEscaped'";
    $checkRes = mysqli_query($conn, $checkSql);
    $exists = false;
    if ($checkRes) {
      $r = mysqli_fetch_assoc($checkRes);
      if ($r && isset($r['cnt']) && $r['cnt'] > 0) {
        $exists = true;
      }
    }

    if ($exists) {
      $_SESSION['message'] = "<p style='color: orange; text-align: center;'>القسم موجود بالفعل ولن يتم تكراره.</p>";
    } else {
      $query = "INSERT INTO section1 (Sectionname) VALUES ('$SectionnameEscaped')";
      if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "<p style='color: green; text-align: center;'>تم إضافة القسم بنجاح.</p>";
      } else {
        $_SESSION['message'] = "<p style='color: red; text-align: center;'>حدث خطأ أثناء الإضافة. يرجى المحاولة مرة أخرى.</p>";
      }
    }
  }

  header('Location: adminpanel.php');
  exit();
}

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
  unset($_SESSION['message']);
}
 @$id=$_GET['id'];// استخدام $id لتحديد القسم المراد حذفه
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم  </title>
    <!--  لاضافة الايقونات -->
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
         <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php echo $message; ?>
  <?php
  
  #delete section
  if(isset($id)){
    $query="DELETE FROM section1 WHERE id='$id'";
    $delete=mysqli_query($conn,$query);
    if(isset($delete)){
     echo "<script>alert('تم حذف القسم بنجاح');</script>";
    }
     else{
      echo "<script>alert('حدث خطاء');</script>";
     }
    
  }
  ?>

  <!-- sidebar start  -->
     <div class="sidebar_container">    
        <div class="sidebar">
            <h1 >لوحة التحكم</h1>
            <ul>
            <li><a href="../index.php" target="_blank">الصفحة الرئيسية <i class="fas fa-home"></i></a></li>
            <li><a href="product.php" target="_blank"> صفحة المنتجات <i class="fas fa-plus"></i></a></li>
            <li><a href="addproduct.php" target="_blank"> اضافة منتج <i class="fas fa-box"></i></a></li>
            <li><a href="users.php" target="_blank">معلومات الاعضاء <i class="fas fa-users"></i></a></li>
            <li><a href="orders.php" target="_blank">الطلبات <i class="fas fa-shopping-cart"></i></a></li>
            <li><a href="logout.php" target="_blank">تسجيل الخروج <i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </div>

      
      <!-- end of sidebar -->
      
      <!-- section start -->
       <div class="content_sec">
      <?php echo $message; ?>
      <form action="adminpanel.php" method="post">
        <label for="Section">  اضافة قسم جديد </label>
        <input type="text" name="Sectionname" id="Section" placeholder="اسم القسم">
        <button type="submit" class='add' name="secadd">اضافة</button>
      </form>
      <br>
        <table>
          <tr>
            <th>رقم القسم</th>
            <th>اسم القسم</th>
            <th>تعديل</th>
            <th>حذف</th>
          </tr>
          <?php
           $query = "SELECT * FROM section1";
           $result = mysqli_query($conn, $query);
           while ($row = mysqli_fetch_assoc($result)) {
            ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['Sectionname']; ?></td>
            <td><button class='edit'>تعديل</button></td>
            <td><a href="adminpanel.php?id=<?php echo $row['id']; ?>"><button class='delete'>حذف</button></td>
          </tr>
          <?php
           }
          ?>
          </table>
            <!-- end of table -->
             </div>
        <!-- end of section -->
         </div>
      
        
    
    </body>
    </html>