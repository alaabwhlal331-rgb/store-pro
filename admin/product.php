<?php 
include ('../include/connected.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المنتجات </title>
    <link rel="stylesheet" href="style.css">
    <style>
        .edit{
    background-color: #2a97a7;
    color: #ffffff;
    border: none;
    padding: 14px 26px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 14px;
    transition: transform 0.2s ease, background-color 0.2s ease;
}
.edit:hover{
    
    background-color: #1d4d4d;
    transform: translateY(-2px);
}

.delete{
    background-color:  #b51a1a;
    color: #ffffff;
    border: none;
    padding: 14px 26px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 14px;
    transition: transform 0.2s ease, background-color 0.2s ease;
}
.delete:hover{
    
    background-color:  #8a0808;
    transform: translateY(-2px);
}
.sidebar_container table img{
    width: 100px;
    height: 100px;
    
}

    </style>
</head>
<body> <br>
<?php
// start delete
@$id = $_GET['id'];
if (isset($id)) {
    $query = "DELETE FROM product WHERE id='$id'";
    $delete = mysqli_query($conn, $query);
    if (isset($delete)) {
        echo "<script>alert('تم حذف المنتج بنجاح');</script>";
    } else {
        echo "<script>alert('حدث خطاء');</script>";
    }
}

?>
    <div class="sidebar_container">    
        <!-- start of table -->
        <table dir="rtl">
            <tr>
                <th>رقم المنتج</th>
                <th>اسم المنتج</th>
                <th>صور المنتج</th>
                <th>سعر المنتج</th>
                <th>الاحجام المتوفرة</th>
                <th>توفر المنتج</th>
                <th>الاقسام</th>
                <th>تفاصيل المنتج</th>
                <th>تعديل المنتج</th>
                <th>حذف المنتج</th>
            </tr>
            <?php
            $query = "SELECT * FROM product";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['Proname']; ?></td>
                <td><img src="../uplaods/img/<?php echo $row['Proimg']; ?>" alt="" style="max-width: 80px; height: auto;"></td>
                <td><?php echo $row['Proprice']; ?></td>
                <td><?php echo $row['Prosize']; ?></td>
                <td><?php echo $row['Prounv']; ?></td>
                <td><?php echo $row['Prosection']; ?></td>
                <td><?php echo $row['Prodescrip']; ?></td>
                <td><a href='update.php?id=<?php echo $row['id']; ?>'><button class='edit'>تعديل</button></td>
                <td><a href='product.php?id=<?php echo $row['id']; ?>'><button class='delete'>حذف</button></a></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <!-- end of table -->
    </div>

    
</body>
</html>