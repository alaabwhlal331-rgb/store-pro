<?php
session_start();
include ('../include/connected.php');

if (!isset($_SESSION['EMAIL'])) {
    header('Location: admin.php');
    exit();
}

$Proname = isset($_POST['Proname']) ? trim($_POST['Proname']) : '';
$Proprice = isset($_POST['Proprice']) ? trim($_POST['Proprice']) : '';
$Prosize = isset($_POST['Prosize']) ? trim($_POST['Prosize']) : '';
$Prosection = isset($_POST['Prosection']) ? trim($_POST['Prosection']) : '';
$Prodescrip = isset($_POST['Prodescrip']) ? trim($_POST['Prodescrip']) : '';
$Prounv = isset($_POST['Prounv']) ? trim($_POST['Prounv']) : '';
$proadd = isset($_POST['proadd']);

$imageName = '';
$imageTmp = '';
if (isset($_FILES['Proimg']) && $_FILES['Proimg']['error'] === UPLOAD_ERR_OK) {
    $imageName = basename($_FILES['Proimg']['name']);
    $imageTmp = $_FILES['Proimg']['tmp_name'];
}

if ($proadd) {
    if (empty($Proname) || empty($Proprice) || empty($Prosize) || empty($Prosection) || empty($Prodescrip) ||  empty($imageName)) {
        echo "<script>alert('ادخل كل البيانات المطلوبة')</script>";
    } else {
        $Proimg = rand(0, 5000) . '_' . $imageName;
        $uploadDir = '../upload/img/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        move_uploaded_file($imageTmp, $uploadDir . $Proimg);

        $query = "INSERT INTO product (Proname, Proprice, Prosize, Prosection, Proimg, Prodescrip, Prounv) VALUES ('$Proname', '$Proprice', '$Prosize', '$Prosection', '$Proimg', '$Prodescrip', '$Prounv')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "<script>alert('تم اضافة المنتج بنجاح')</script>";
        } else {
            echo "<script>alert('حدث خطاء')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اضافة منتج</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* start addproduct css */
main {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding: 24px 16px;
}

.form_product {
    width: min(760px, 100%);
    background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%);
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 32px 28px;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
    text-align: right;
}

.form_product h1 {
    display: block;
    margin-bottom: 20px;
    font-size: 1.8rem;
    color: #1e293b;
    font-weight: 700;
}

.form_product form {
    display: grid;
    gap: 12px;
}

.form_product label {
    font-weight: 600;
    color: #334155;
    margin-bottom: 6px;
    display: block;
}

.form_product input,
.form_product select,
.form_product textarea {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 4px;
    box-sizing: border-box;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    background: #fff;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form_product input:focus,
.form_product select:focus,
.form_product textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
}

.form_product input[type="file"] {
    padding: 10px;
    background: #f8fafc;
}


 .button {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    color: #ffffff;
    padding: 14px 24px;
    border: none;
    border-radius: 999px;
    cursor: pointer;
    font-weight: 700;
    letter-spacing: 0.3px;
    transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.22);
    width: fit-content;
    margin-top: 8px;
    margin-right: auto;
}

.button:hover {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(37, 99, 235, 0.28);
}

#form_control {
    width: 100%;
    padding: 12px 14px;
    margin-bottom: 4px;
    box-sizing: border-box;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    background: #fff;
}
    </style>
</head>
<body>
  <center>
    <main>
        <div class='form_product'>
            <h1>اضافة منتج</h1>
            <form action="addproduct.php" method="post" enctype="multipart/form-data" > <!--//للسماح برفع صورة -->
              <label for="name">اسم المنتج</label>
              <input type="text" name="Proname" id="name" placeholder="اسم المنتج">

               <label for="image">صورة المنتج</label>
              <input type="file" name="Proimg" id="picture">

              <label for="price">سعر المنتج</label>
              <input type="text" name="Proprice" id="price" placeholder="سعر المنتج">

              <label for="description">وصف المنتج</label>
              <input type="text" name="Prodescrip" id="description" placeholder="وصف المنتج">

              <div >
              <label for="size">الاحجام المتوفرة</label>
              <input type="text" name="Prosize" id="size">

                
             
              <!-- start section -->
               <div >
              <label for="form_control">القسم </label>
              <select name="Prosection" id="form_control">
              <?php
              $query="SELECT * FROM section1";
              $result=mysqli_query($conn,$query);
              while($row=mysqli_fetch_assoc($result)){
                echo "<option name='section1'>".$row['Sectionname']."</option>";
              }
              ?>


                <option value="">ملابس </option>
                <option value=""> احذية</option>
                <option value="">هواتف</option>
                <option value="">اكسسوارات</option>
                <option value="">حقائب</option>
              </select>
              </div>
               <br>
              <!-- end section -->
             
             
          
              <button class="button" type="submit" name="proadd">إضافة</button>
            
            </form>
        </div>
    </main>
  </center>  
</body>
</html>