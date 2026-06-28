<?php

include ('file/header.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.</title>
   <link rel="stylesheet" href="style.css">
    <style>
        /* start product */
.products-section {
    padding: 24px 14px 40px;
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(5, minmax(170px, 1fr));
    gap: 14px;
    align-items: stretch;
    height:  500px;
}
.products-grid {
    display: contents;
}
.product {
    position: relative;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 22px rgba(23, 22, 28, 0.08);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    display: flex;
    flex-direction: column;
    width: 100%;
    border: 1px solid #f1e5e5;
    min-height: 100%;
}
.product:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(23, 22, 28, 0.12);
}
.product a {
    text-decoration: none;
    color: #2f2f2f;
    font-weight: 600;
    margin: 0;
}
.product_img {
    text-align: center;
    overflow: hidden;
    width: 100%;
    background: #fcf7f4;
    padding: 8px;
}
.product_img img {
    width: 100%;
    height: 150px;
    display: block;
    object-fit: cover;
    border-radius: 12px;
    transition: transform 0.25s ease;
}
.product:hover .product_img img {
    transform: scale(1.03);
}
.product > .product-section,
.product > .product-name,
.product > .product-price,
.product > .product-description,
.product > .product-actions {
    padding: 0 10px;
}
.product-section {
    margin-top: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: fit-content;
    padding: 5px 8px;
    background: rgba(155, 95, 95, 0.1);
    color: #9b5f5f;
    font-size: 0.64rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    border-radius: 999px;
    text-transform: uppercase;
}
.product-name {
    font-size: 0.92rem;
    margin: 7px 0 4px;
    font-weight: 800;
    color: #1e1e1e;
    line-height: 1.3;
    min-height: 38px;
}
.product-price {
    color: #9b5f5f;
    font-size: 0.95rem;
    font-weight: 800;
    margin-bottom: 6px;
}
.product-description {
    margin-bottom: 8px;
    display: flex;
    justify-content: flex-end;
}
.product-description a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #f6ece8;
    color: #9b5f5f;
    font-size: 0.8rem;
}
.qty_input {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    margin: 0 10px 8px;
    padding: 6px 8px;
    background: #f8f0ec;
    border-radius: 999px;
}
.qty-count {
    width: 28px;
    height: 28px;
    border: none;
    border-radius: 50%;
    background: #ffffff;
    color: #9b5f5f;
    cursor: pointer;
    transition: background-color 0.2s ease, transform 0.2s ease;
}
.qty-count:hover {
    background: #f1e8e7;
    transform: scale(1.03);
}
.qty-input {
    width: 40px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 700;
    color: #333;
    font-size: 14px;
}
.product-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    padding: 0 10px 10px;
}
.product-actions .btn {
    border: none;
    border-radius: 999px;
    padding: 8px 6px;
    cursor: pointer;
    font-weight: 700;
    transition: background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    font-size: 0.76rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
}
.product-actions .btn-primary {
    background: linear-gradient(135deg, #9b5f5f 0%, #b86f6f 100%);
    color: #ffffff;
    box-shadow: 0 8px 16px rgba(155, 95, 95, 0.16);
}
.product-actions .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 18px rgba(155, 95, 95, 0.2);
}
.product-actions .btn-secondary {
    background: #f4f4f4;
    color: #333333;
}
.product-actions .btn-secondary:hover {
    background: #e8e8e8;
}
@media (max-width: 1200px) {
    .products-section {
        grid-template-columns: repeat(4, minmax(170px, 1fr));
    }
}
@media (max-width: 900px) {
    .products-section {
        grid-template-columns: repeat(3, minmax(170px, 1fr));
    }
}
@media (max-width: 650px) {
    .products-section {
        grid-template-columns: repeat(2, minmax(150px, 1fr));
    }
}
@media (max-width: 480px) {
    .products-section {
        grid-template-columns: 1fr;
    }
}

input[type="number"]{
    font-size: 16px;
}

/* end product */

    </style>
</head>
<body>
    
</body>
</html>
<?php
if(isset($_GET['btn_search'])){
    $search =$_GET['search'];
   $query = 'SELECT * FROM product WHERE Prodescrip LIKE "%'.$search.'%" 
          OR Proname LIKE "%'.$search.'%" 
          OR Prosection LIKE "%'.$search.'%" 
          OR Proprice LIKE "%'.$search.'%"';
    $result=mysqli_query($conn,$query);
    if (mysqli_num_rows($result)>0){
        while($row=mysqli_fetch_assoc($result)){
            echo  '<div class="product">
<!-- product image -->
<div class="product_img">
    <img src="../uplaod/img//'.$row['Proimg'].'" alt="Mmmm">
    <span class="unvailable">'.$row['Prounv'].'</span>
    <a href=""></a>
</div>
   <!-- section -->
<div class="product-section">
<a href="">'.$row['Prosection'].'</a>
</div>
<!-- name -->
<div class="product-name">
    <a href="">'.$row['Proname'].'</a>
</div>
<!-- price -->
<div class="product-price">
<a href=""> '.$row['Proprice'].' &nbsp; EGP</a>
</div>
<!-- description -->
<div class="product-description">
<a href="details.php"><i class="fa-solid fa-circle-info"> '.$row['Prodescrip'].'</i></a>
</div>
<!-- quantity -->
    <div class="qty_input">
        <button class="qty-count mins"><i class="fa-solid fa-minus"></i></button>
        <input type="number" id="quantity" class="qty-input" value="1" min="1" max="7">
        <button class="qty-count add"><i class="fa-solid fa-plus"></i></button>
    </div>
<!-- actions -->
<div class="product-actions">
    <button class="btn btn-primary">
        <i class="fa-solid fa-cart-shopping"></i>
        <span>Add to cart</span>
    </button>
    <button class="btn btn-secondary">
        <i class="fa-solid fa-heart"></i>
        <span>Wishlist</span>
    </button>
</div>
</div>';

        }//end while
    }//end if
    else {
        echo "no result found";
    }
}
?>  
<?php
include('file/footer.php');
?>
