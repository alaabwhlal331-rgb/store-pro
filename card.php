<?php
session_start();
if(!isset($_SESSION['user_id'])){
    echo '<script>alert( " يرجى تسجيل الدخول اولا لاضافة المنتج الى السلة "); 
    window.location.href="user/login.php";</script>';
}
$user_id=$_SESSION['user_id'];
if($user_id<=0){
    echo '<script>alert(" مستخدم غير صحيح"); 
    window.location.href="user/login.php";</script>';
}
?>
<?php
session_start();
include('file/header.php');
include('file/footer.php');
?>
<?php
@$add=$_POST['add'];
if(isset($_POST['add'])){
   @$ID =$_POST['id'];
   $productname=$_POST['h_name'];
   $productprice=$_POST['h_price'];
   $productimg=$_POST['h_img'];
   $productquantity=$_POST['quantity'];
   $productid=$_POST['product_id'];

   $add_cart = "SELECT * FROM card  WHERE name='$productname' AND user_id='$user_id'";
   $result=mysqli_query($conn,$add_cart);
   if(mysqli_num_rows($result)>0){
    echo "<script>alert('المنتج موجود بالفعل من قبل')</script>";
  
   }
   else{
    if ($user_id>0){
   $insert_cart='INSERT INTO card (product_id,name,price,img,quantity,user_id) VALUES 
   ( "'.$productid.'","'.$productname.'","'.$productprice.'","'.$productimg.'","'.$productquantity.'","'.$user_id.'")';
  if(mysqli_query($conn,$insert_cart)==true){
    echo "<script>alert('تم اضافة المنتج بنجاح')</script>";
  }
  else{
    echo "<script>alert(' لم يتم اضافة المنتج')</script>";
  }
   }
}
}
// start delete
@$delete_c = $_POST['delete_c'];
if(isset($_POST['delete_c'])){
  @$ID =$_POST['id'];
  if($ID){
   $query="DELETE FROM card WHERE id='$ID' AND user_id='$user_id'";
   $delete=mysqli_query($conn,$query);
   if($delete){
    echo "<script>alert('تم حذف المنتج بنجاح')</script>";
   }
    else{
     echo "<script>alert('لم يتم حذف المنتج')</script>";
    }
  }
  
}
// end delete
// start update

if(isset($_POST['update_quantity'])){
  $product_id = $_POST['product_id'];
  @$new_quantity = $_POST['quantity'];
  @$user_id = $_POST['user_id'];
  $update_q="UPDATE card SET quantity='$new_quantity' WHERE id='$product_id' AND user_id='$user_id'";
  if(mysqli_query($conn,$update_q)){
    echo "<script>alert('تم تعديل الكمية بنجاح')</script>";
  }
  else{
    echo "<script>alert('لم يتم تعديل الكمية')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      direction: rtl;
    }
    h3{
      font-family: 'Tajawal', sans-serif;
      color:black;
    }
    body{
      font-family: 'Tajawal', sans-serif;
      background-color: #f1f1f1;
      color: #333;
    }
    .container{
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .cont_head{
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }
    .cont_head img{
      width: 50px;
      height: 50px;
      margin-right: 10px;
    }
    .cont_head h1{
      font-size: 24px;
      color: #333;
    }
    .cart_table{
      width: 100%;
      border-collapse: collapse;
    }
    .cart_table th,
    .cart_table td{
      padding: 10px;
      text-align: center;
      border: 1px solid #ccc;
    }
    .cart_table th{
      background-color: #f2f2f2;
      font-weight: bold;
    }
    .cart_table td img{
      width: 100px;
      height: 100px;
      object-fit: cover;
    }
    .cart_table input[type="text"]{
      width: 50px;
      text-align: center;
    }
    
   
     .remove{
      background-color: #7f221f;
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      radius: 14px;

     }
     .remove:hover{
      background-color: #5b0c0c;

     }
     .edit{
      background-color: #1f8119;
      color: #ffffff;
      border: none;
      padding: 14px 26px;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 14px;
      transition: transform 0.2s ease, background-color 0.2s ease;
     }
     .edit:hover{
      background-color: #124f0f;
      transform: scale(1.1);
     }
    .cart_table a{
      text-decoration: none;
      color: #333;
    }
    .cart_table a:hover{
      text-decoration: underline;
    }
    .cart_table button{
      padding: 10px 40px;
      transition: transform 0.3s ease;
    }
    .cart_table button:hover{
      transform: scale(1.1);
    }
    .remove_cart{
      background-color: #9536f4;
      color: #fff;
      border: none;
      padding: 10px 40px;
      transition: transform 0.3s ease;
      radius: 10px;
    }
    .remove_cart a{
      text-decoration: none;
      color: #fff;
      
    }

    .remove_cart:hover{
      transform: scale(1.1);
    }
     h6{
      text-align: center;
      margin-top: 20px;
      font-size: 24px;
      color: #333;
     }

    </style>
</head>
<body>
  <div class="container">
    <div claa='cont_head'>
      <img src="img/logo.png" alt="logo">
      <?php
      // استعلام لاسترجاع اسم المستخدم من قاعدة البيانات
      $query_user="SELECT username FROM users WHERE id='$user_id'";
      $result_user = mysqli_query($conn, $query_user);
      if($result_user){
        if(mysqli_num_rows($result_user) > 0){
         while($row = mysqli_fetch_assoc($result_user)){
          // عرض اسم المستخدم
           echo "<h1>مرحبا " . $row['username'] . "</h1>";
         }
        }else{
          echo "<h1>لا توجد نتائج للمستخدم </h1>";
        }

        
      }
      ?>
      <h1>المنتجات</h1>
    </div>
    <!-- start table -->
   <table class='cart_table'>
    <tr>
      <th>الصورة</th>
      <th>رقم المنتج</th>
      <th>الاسم</th>
      <th>السعر</th>
      <th>الكمية</th>
      <th>الاجمالي</th>
      <th>حذف المنتج</th>
      <th>تعديل المنتج</th>
    </tr>
    <?php
    $query = "SELECT * FROM card WHERE user_id='$user_id'" ;
    $result = mysqli_query($conn, $query);
    $total = 0;
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        $total += $row['price'] * $row['quantity'];
      
    ?>
    

    <tr>
      <td><img src = "../uplaod/img/<?php echo $row['img']; ?>"></td>
      <td><h3><?php echo $row['product_id']; ?> </td>
      <td><h3><?php echo $row['name']; ?></td>
     
      <td><h3><?php echo $row['price']; ?></h3> </td>
       <td><input  value='<?php echo $row['quantity']; ?>'></td>
      <td><h3><?php echo number_format($row['price'] * $row['quantity']); ?></td>
      <!--  start delete -->
      <td>
        <form action="card.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button class='remove' type="submit" name="delete_c">حذف <i class="fa-solid fa-trash"></i> </button> 
        </form>
      </td>
      <!-- end delete -->
       <!-- start edit -->
     
      <td>
        <form action="card.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
         <input type="number" name="quantity" value="<?php echo $row['quantity']; ?> " required>
         <button class='edit' type="submit" name="update_quantity">تعديل <i class="fa-solid fa-pen-to-square"></i> </button>
        </form>
        </td>
      <?php
      $total += $row['price'] * $row['quantity'];
      $_SESSION['total'] = $total;
      }
    }
      ?>
      </tr>
      </table>
      <!-- end table -->
    <div class="cart_total">
      <h6 >$<?php echo number_format($total); ?> <span id ="total">الاجمالي</span></h6>
      <button class="remove_cart" type="submit"><a href='checkout.php'><h2>تاكيد الطلب</h2></a></button>
    </div>
  </div>

</body>
</html>