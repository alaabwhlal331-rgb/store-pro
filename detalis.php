<?php
include('file/header.php');
?>
<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تفاصيل المنتج</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Tajawal:wght@400;500;700&display=swap');

:root{
    --bg: #FBF7F4;
    --card: #FFFFFF;
    --ink: #2A2522;
    --ink-soft: #6B6058;
    --rose: #9B5F5F;
    --rose-deep: #7E4949;
    --rose-tint: rgba(155, 95, 95, 0.1);
    --line: #F1E5E5;
}

*{ box-sizing: border-box; }

body{
    margin: 0;
    background: var(--bg);
    font-family: 'Tajawal', sans-serif;
    color: var(--ink);
    direction: rtl;
}

main{
    max-width: 1080px;
    margin: 0 auto;
    padding: 48px 20px 24px;
}

/* ===== Container / Card ===== */
.container{
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 0;
    background: var(--card);
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 18px 40px rgba(23, 22, 28, 0.08);
    border: 1px solid var(--line);
}

@media (max-width: 760px){
    .container{ grid-template-columns: 1fr; }
}

/* ===== Image side ===== */
.product_img{
    width: 100%;
    height: 100%;
    min-height: 380px;
    background: var(--rose-tint);
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
}
.product_img img{
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.product_img::after{
    content: 'متوفر الآن';
    position: absolute;
    top: 16px;
    right: 16px;
    background: var(--rose);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
    letter-spacing: 0.02em;
}

/* ===== Info side ===== */
.product_info{
    padding: 36px 38px;
    display: flex;
    flex-direction: column;
}

.product_title{
    font-family: 'Cairo', sans-serif;
    font-size: 1.9rem;
    font-weight: 800;
    margin: 0 0 6px;
    color: var(--ink);
}

.product_price{
    font-family: 'Cairo', sans-serif;
    font-size: 1.45rem;
    font-weight: 800;
    color: var(--rose);
    margin: 0 0 18px;
    display: flex;
    align-items: baseline;
    gap: 6px;
}
.product_price small{
    font-size: 0.85rem;
    font-weight: 600;
    color: var(--ink-soft);
}

.divider{
    border: none;
    border-top: 1px solid var(--line);
    margin: 6px 0 18px;
}

/* size selector — signature element */
.size_label{
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--ink-soft);
    margin: 0 0 10px;
}
.size_options{
    display: flex;
    gap: 10px;
    margin-bottom: 22px;
    flex-wrap: wrap;
}
.size_chip{
    min-width: 46px;
    height: 42px;
    padding: 0 10px;
    border-radius: 12px;
    border: 1.5px solid var(--line);
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    color: var(--ink-soft);
    cursor: pointer;
    transition: all 0.2s ease;
}
.size_chip:hover{
    border-color: var(--rose);
    color: var(--rose);
}
.size_chip.active{
    background: var(--rose);
    border-color: var(--rose);
    color: #fff;
}

.product_description{
    font-size: 0.95rem;
    line-height: 1.8;
    color: var(--ink-soft);
    margin: 0 0 24px;
}

/* quantity */
.qty_input{
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #f8f0ec;
    border-radius: 999px;
    padding: 6px 8px;
    margin-bottom: 22px;
    width: fit-content;
}
.qty-count{
    width: 34px;
    height: 34px;
    border: none;
    border-radius: 50%;
    background: #ffffff;
    color: var(--rose);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background-color 0.2s ease, transform 0.15s ease;
}
.qty-count:hover{
    background: var(--line);
    transform: scale(1.05);
}
.qty-input{
    width: 46px;
    height: 34px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 700;
    color: var(--ink);
    font-size: 15px;
}

/* submit */
.submit a{
    text-decoration: none;
    display: block;
}
.add_cart{
    width: 100%;
    background: linear-gradient(135deg, var(--rose) 0%, var(--rose-deep) 100%);
    color: #fff;
    border: none;
    padding: 15px 24px;
    font-size: 1rem;
    font-weight: 700;
    border-radius: 14px;
    cursor: pointer;
    box-shadow: 0 10px 20px rgba(155, 95, 95, 0.22);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    font-family: 'Tajawal', sans-serif;
}
.add_cart:hover{
    transform: translateY(-2px);
    box-shadow: 0 14px 26px rgba(155, 95, 95, 0.28);
}

/* ===== Comments section ===== */
.comment_info{
    max-width: 1080px;
    margin: 36px auto 60px;
    padding: 0 20px;
}
.comment_info h5{
    font-family: 'Cairo', sans-serif;
    font-size: 1.15rem;
    font-weight: 700;
    margin: 0 0 16px;
    color: var(--ink);
}
.comment_form{
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 18px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 28px;
}
.comment_form textarea{
    resize: vertical;
    min-height: 90px;
    border: 1.5px solid var(--line);
    border-radius: 12px;
    padding: 12px 14px;
    font-family: 'Tajawal', sans-serif;
    font-size: 0.92rem;
    color: var(--ink);
    outline: none;
    transition: border-color 0.2s ease;
}
.comment_form textarea:focus{
    border-color: var(--rose);
}
.add_comment{
    align-self: flex-start;
    background: var(--rose);
    color: #fff;
    border: none;
    padding: 10px 26px;
    font-weight: 700;
    border-radius: 999px;
    cursor: pointer;
    font-family: 'Tajawal', sans-serif;
    transition: background-color 0.2s ease;
}
.add_comment:hover{
    background: var(--rose-deep);
}

.reviews_title{
    font-family: 'Cairo', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    margin: 0 0 14px;
    color: var(--ink);
}
.comments{
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 14px;
    padding: 16px 18px;
    font-size: 0.9rem;
    color: var(--ink-soft);
    position: relative;
    padding-right: 46px;
}
.comments::before{
    content: '★★★★★';
    position: absolute;
    top: 16px;
    right: 18px;
    font-size: 0.7rem;
    color: var(--rose);
    letter-spacing: 1px;
}
.comments span{
    display: block;
    font-weight: 700;
    color: var(--ink);
    margin-bottom: 4px;
    font-size: 0.85rem;
}
</style>
</head>
<body>

<main>
    <?php
    $id=$_GET['id'];// استخدام $id لتحديد القسم المراد حذفه
    if(isset($_GET['id'])){ // استخدام isset() للتحقق من وجود $id في الرابط
        $query="SELECT * FROM product WHERE id='$id'";// استخدام $id للتحقق من القسم المراد حذفه
        $result=mysqli_query($conn,$query);// استخدام $conn للاتصال بقاعدة البيانات
       
          $row = mysqli_fetch_assoc($result);// استخدام $result للحصول على النتائج المراد عرضها
         
        
    }
    ?>
    <!-- start container -->
    <div class="container">
        <div class="product_img">
            <img src="../uplaod/img/<?php echo $row['Proimg']; ?>" alt="Medical Shoes">
        </div>
        <!-- end product image -->
         <!-- start information -->

        <div class="product_info">
            <h1 class="product_title"><?php echo $row['Proname']; ?></h1>
            <h2 class="product_price"><?php echo $row['Proprice']; ?> <small>EGP</small></h2>
             <!-- section -->
            <div class="product-section">
            <a href="section.php?section=<?php echo $row ['Prosection']?>">
                <?php echo $row['Prosection']; ?></a>
            </div>
            <hr class="divider">

            <p class="size_label"><?php echo $row['Prosize']; ?>. </p>
            <div class="size_options"> 
                <div class="size_chip active">S</div>
                <div class="size_chip">M</div>
                <div class="size_chip">L</div>
                <div class="size_chip">XL</div>
            </div>

            <p class="product_description"><?php echo $row['Prodescrip']; ?>.</p>
          <!-- quantity -->
            <div class="qty_input">
                <button class="qty-count mins"><i class="fa-solid fa-minus"></i></button>
                <input type="number" id="quantity" class="qty-input" value="1" min="1" max="7">
                <button class="qty-count add"><i class="fa-solid fa-plus"></i></button>
            </div>
           <!-- end quantity -->
            <!-- submit -->
            <div class="submit">
                <a href="">
                    <button class="add_cart" type="submit">إضافة إلى السلة</button>
                </a>
            </div> <!-- end submit -->
        </div> <!-- end information -->
    </div> <!-- end container -->
</main>
<!-- comments -->
 
<div class="comment_info">
    <?php
 //add comment
 @$comment = $_POST['comment'];
 @$add_comment = $_POST['add_comment'];
 if (isset($add_comment)) {
     $query = "INSERT INTO comments (comment) VALUES ('$comment')";
     $result = mysqli_query($conn, $query);
     if ($result) {
         echo "<script>alert('تم اضافة التعليق بنجاح')</script>";
         echo "<script>window.location.href='detalis.php?id=$id'</script>";
     }
     else {
         echo "<script>alert('حدث خطاء')</script>";
     }
 }

 $query = "SELECT * FROM comments";
 $result = mysqli_query($conn, $query);
 ?>
    <h5>هل تود التعليق على المنتج؟</h5>
    <form action="" method="post" class="comment_form">
        <textarea name="comment" placeholder="اكتب تعليقك" ></textarea>
        <button class="add_comment" type="submit" name="add_comment">إرسال</button>
    </form>

    <p class="reviews_title">تقييمات العملاء</p>
     <div class="comments"> <br>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="comments"> '.$row['comment'].'</div>';
           

        }
    }
        else {
            echo '<div class="comments">لا يوجد تعليقات</div>';
        }
    
    ?>
     </div>
</div>
<!-- end comments -->

</body>
</html>
