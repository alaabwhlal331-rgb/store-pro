<?php
include('file/header.php');
include('file/footer.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>section</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <?php
        $section = $_GET['section'];
        $query = "SELECT * FROM product WHERE Prosection = '$section' ORDER BY id DESC";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){

            ?>
            <div class="products-grid">
        <div class="product">
            <!-- product image -->
            <div class="product_img"><a href="detalis.php?id=<?php echo $row ['id']?>">
                <img src="../uplaod/img/<?php echo $row['Proimg']; ?>" alt="Medical Shoes">
                <span class='unvailable'><?php echo $row['Prounv']; ?></span>
                <a href=''></a>
            </div>
               <!-- section -->
            <div class="product-section">
            <a href="detalis.php?id=<?php echo $row ['id']?>">
                <?php echo $row['ProSection']; ?></a>
            </div>
            <!-- name -->
            <div class="product-name">
                <a href="detalis.php?id=<?php echo $row ['id']?>"><?php echo $row['Proname']; ?></a>
            </div>
            <!-- price -->
            <div class="product-price">
            <a href="detalis.php?id=<?php echo $row ['id']?>"><?php echo $row['Proprice']; ?> EGP</a>
            </div>
            <!-- description -->
            <div class="product-description">
            <a href="detalis.php?id=<?php echo $row ['id']?>"><i class="fa-solid fa-circle-info"></i></a>
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
        </div>
    </div><!-- end product -->
            <?php
            }
        }else{
            echo "لا يوجد منتجات";
        }
        
        ?>
    </main>
</body>
</html>