<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};
/*
if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['p_price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $saleprice = $_POST['sale_price'];
   $saleprice = filter_var($saleprice, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $color = $_POST['p_color'];
   $color = filter_var($color, FILTER_SANITIZE_STRING);
   $status = $_POST['p_status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   $tag = $_POST['tag'];
   $tag = filter_var($tag, FILTER_SANITIZE_STRING);
   $weight = $_POST['weight'];
   $weight = filter_var($weight, FILTER_SANITIZE_STRING);
   $total_review = $_POST['total_review'];
   $total_review = filter_var($total_review, FILTER_SANITIZE_STRING);
   $availability = $_POST['p_availability'];
   $availability = filter_var($availability, FILTER_SANITIZE_STRING);
   $c_id = $_POST['c_id'];
   $c_id = filter_var($c_id, FILTER_SANITIZE_STRING);

   $image = $_FILES['p_image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['p_image']['size'];
   $image_tmp_name = $_FILES['p_image']['tmp_name'];
   $image_folder = '../images/products/'.$image;

   $image_01 = $_FILES['p_image']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['p_image1']['size'];
   $image_tmp_name_01 = $_FILES['p_image1']['tmp_name'];
   $image_folder_01 = '../images/products/'.$image_01;

   $image_02 = $_FILES['p_image2']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['p_image2']['size'];
   $image_tmp_name_02 = $_FILES['p_image2']['tmp_name'];
   $image_folder_02 = '../images/products/'.$image_02;

   $image_03 = $_FILES['p_image3']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['p_image3']['size'];
   $image_tmp_name_03 = $_FILES['p_image3']['tmp_name'];
   $image_folder_03 = '../images/products/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `bdu_product` WHERE p_name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `bdu_product`(p_name, p_image, p_image1, p_image2, p_image3, p_color, p_price, sale_price, p_status, tag, weight, total_review, p_availability, 	p_description, c_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $image, $image_01, $image_02, $image_03, $color, $price, $saleprice, $status, $tag, $weight, $total_review, $availability, $details, $c_id]);

      if($insert_products){
         if($image_size > 2000000 OR $image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};
*/

if(isset($_POST['add_product'])){

   $p_id = $_POST['p_id'];
   $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $p_color = $_POST['p_color'];
   $p_color = filter_var($p_color, FILTER_SANITIZE_STRING);
   $price = $_POST['p_price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $sale_price = $_POST['sale_price'];
   $sale_price = filter_var($sale_price, FILTER_SANITIZE_STRING);
   $p_status = $_POST['p_status'];
   $p_status = filter_var($p_status, FILTER_SANITIZE_STRING);
   $p_availability = $_POST['p_availability'];
   $p_availability = filter_var($p_availability, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
   $c_id = $_POST['c_id'];
   $c_id = filter_var($c_id, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../images/products/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../images/products/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../images/products/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `bdu_product` WHERE p_name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_products = $conn->prepare("INSERT INTO `bdu_product`(`p_id`, `p_name`, `p_image`, `p_image1`, `p_image2`, `p_image3`, `p_color`, `p_price`, `sale_price`, `p_status`, `tag`, `weight`, `total_review`, `p_availability`, `p_description`, `c_id`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_products->execute([$p_id, $name, $image_01, $image_01, $image_02, $image_03, $p_color, $price, $sale_price, $p_status, 1, 1, 'come for review', $p_availability, $details, $c_id]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'new product added!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `bdu_product` WHERE p_id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../images/products/'.$fetch_delete_image['p_image']);
   unlink('../images/products/'.$fetch_delete_image['p_image1']);
   unlink('../images/products/'.$fetch_delete_image['p_image2']);
   unlink('../images/products/'.$fetch_delete_image['p_image3']);
   $delete_product = $conn->prepare("DELETE FROM `bdu_product` WHERE p_id = ?");
   $delete_product->execute([$delete_id]);
   header('location:products.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="add-products">

   <h1 class="heading">add product</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
      <div class="inputBox">
            <span>product ID (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product ID" onkeypress="if(this.value.length == 10) return false;" name="p_id">
         </div>
         <div class="inputBox">
            <span>product name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
         </div>
         <div class="inputBox">
            <span>product color (optional)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product color" name="p_color">
         </div>
         <div class="inputBox">
            <span>product price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="p_price">
         </div>
         <div class="inputBox">
            <span>product sale price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product sale price" onkeypress="if(this.value.length == 10) return false;" name="sale_price">
         </div>
         <div class="inputBox">
            <span>product status (Featured, On Sale, Best Rated)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product status" name="p_status">
         </div>
         <div class="inputBox">
            <span>product availability (In Store, Out of Store)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product availability" name="p_availability">
         </div>
         <div class="inputBox">
            <span>product category (1--5)</span>
            <input type="number" class="box" required max="5" placeholder="enter product category" name="c_id">
         </div>
        
        <div class="inputBox">
            <span>image 1 (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 2 (required)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 3 (required)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>product Description (required)</span>
            <textarea name="details" placeholder="enter product details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="add product" class="btn" name="add_product">
   </form>

</section>
<section class="show-products">

   <h1 class="heading">products added</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `bdu_product`");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../images/products/<?= $fetch_products['p_image']; ?>" alt="">
      <div class="name"><?= $fetch_products['p_name']; ?>[Product ID=<?= $fetch_products['p_id']; ?>]</div>
      <div class="price"><span>$<?= $fetch_products['sale_price']; ?></span></div>
      <div class="details"><span><?= $fetch_products['p_description']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['p_id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['p_id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>
   
   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>