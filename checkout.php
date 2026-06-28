<?php
include ('include/connected.php');
// بداية الجلسة
session_start();
// التحقق من تسجيل الدخول
if(!isset($_SESSION['user_id'])){
    echo '<script>alert( " يرجى تسجيل الدخول اولا لاضافة المنتج الى السلة "); 
    window.location.href="user/login.php";</script>';
}
// تحقق من صحة المستخدم
$user_id=$_SESSION['user_id'];
$query="SELECT * FROM card WHERE user_id='$user_id'";
$result=mysqli_query($conn,$query);
echo mysqli_num_rows($result);
$total=0;
$rows=[];
while($row=mysqli_fetch_assoc($result)){
    $total+=$row['quantity']*$row['price'];
    $rows[]=$row;
}
if(isset($_POST['confirm_order'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    @$email=$_POST['email'];
    $adress=$_POST['adress'];
    $insert_order="INSERT INTO orders (user_id,name,phone,email,adress,total) VALUES
    ('$user_id','$name','$phone','$email','$adress','$total')";
    $order_id=mysqli_insert_id($conn);
    foreach($rows as $row){
        $insert_items="INSERT INTO order_items (order_id,product_id,product_name,price,quantity,
        img) VALUES ('$order_id','$row[product_id]','$row[name]','$row[price]','$row[quantity]','$row[img]')";
        mysqli_query($conn,$insert_items);
       echo '<script>alert(" تم تأكيد طلبك بنجاح ! رقم الطلب هو : '.$order_id.'  ");
       window.location.href="checkout.php?order_id='.$order_id.'";</script>';
    }
    // حذف المنتجات الموجودة في سلة الشراء
    $delete_cart="DELETE FROM card WHERE user_id='$user_id'";
    mysqli_query($conn,$delete_cart); 
    
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة اتمام الطلب </title>
    <link rel="stylesheet" href="checkout.css">
     <!-- ربط أيقونات Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>
<body>
   <div class="container">
    <section class="checkout-form">
        <h1> شكراً لتسوقك من متجرنا لقد طلبت المنتجات التالية </h1>
        <form action="" method="POST">
            <!-- استرجاع المنتجات التي تم طلبها المستخدم في سلة الشراء  -->
             <div class="display-order">
                <?php
               foreach($rows as $row){

                ?>
                <div class="product-box">
                    <img src="uplaod/img/1.jpg <?php echo $row['img']; ?>"  style="width: 100px" height="100px">
                    <p><i class='fa-solid fa-cubes'></i><?php echo $row['name']; ?></p>
                    <p>الكمية<?php echo $row['quantity']; ?>   </p>
                    <p><i class='fa-solid fa-dollar-sign'></i><?php echo $row['price']; ?>   </p>
                   </div>

            
                <?php
                }
                ?>
                </div>
                <!-- المجموع -->
                <div class='total-price'>
                    <i class='fa-solid fa-dollar-sign'></i> <?php echo $total; ?> المجوع الكلي   </div>
                     
                    <h5 >قم بتعبئة بياناتك بشكل صحيح ليصل طلبك في اسرع وقت ممكن</h5>
                
                        <div  class ='input-group'>
                        <label> الاسم الكامل </label>
                        <input type="text"  name='name' placeholder="ادخل اسمك " required>
                        </div><!--input-group-->

                        <div  class ='input-group'>
                        <label> البريد الالكتروني</label>
                        <input type="email"  name='	email' placeholder=" ادخل بريدك الالكتروني" required>
                        </div><!--input-group-->

                        <div  class ='input-group'>
                        <label>رقم الهاتف</label>
                        <input type="text"  name='phone' placeholder=" ادخل رقم الهاتف" required>
                        </div><!--input-group-->

                        <div  class ='input-group'>
                        <label> العنوان</label>
                        <input type="text"  name='adress' placeholder=" ادخل عنوانك التفصيلي " required>
                        </div><!--input-group-->

                        
                        <!-- زر تاكيد الطلب  -->
                        <button type="submit" class="btn" name ="confirm_order">تاكيد الطلب </button>

                    
                   </form>
                   </section><!--checkout-form-->

    </div> <!-- end container -->
</body>
</html>