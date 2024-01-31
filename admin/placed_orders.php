<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['payment_data_id'];
   $payment_status = $_POST['state'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `bdu_payment_data` SET state = ? WHERE payment_data_id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}
if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `bdu_payment_data` WHERE payment_data_id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>placed orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="orders">

<h1 class="heading">placed orders</h1>

<div class="box-container">

   <?php
      //$select_orders = $conn->prepare("SELECT * FROM `bdu_shipment`,`bdu_invoice_table`, `bdu_payment_data`, `bdu_order`,`bdu_customer`, `bdu_order_detail` WHERE bdu_customer.cu_id=bdu_order.cu_id AND bdu_order_detail.o_id=bdu_order.o_id AND bdu_payment_data.invoice_id= bdu_invoice_table.invoice_id AND bdu_shipment.invoice_id= bdu_invoice_table.invoice_id");
      $select_orders = $conn->prepare("SELECT * FROM `bdu_shipment`, `bdu_payment_data`, `bdu_order`,`bdu_order_detail`,`bdu_customer` WHERE bdu_shipment.order_number=bdu_order.order_number AND bdu_customer.cu_id=bdu_order.cu_id AND  bdu_payment_data.invoice_id= bdu_shipment.invoice_id AND bdu_order_detail.o_id=bdu_order.o_id ");
      $select_orders->execute();
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> placed on : <span><?= $fetch_orders['ordered_delivery_date']; ?></span> </p>
      <p> Orderd By : <span><?= $fetch_orders['cu_fname']; ?></span> </p>
      <p> Product Id : <span><?= $fetch_orders['p_id']; ?></span> </p>
      <p> Phone : <span><?= $fetch_orders['cu_phone']; ?></span> </p>
      <p> Address : <span><?= $fetch_orders['cu_address']; ?></span> </p>
      <p> total products : <span><?= $fetch_orders['o_total_qty']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders['o_total_price']+$fetch_orders['shipping_charge']; ?></span> </p>
      <p> payment method : <span><?= $fetch_orders['payment_type_code']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="payment_data_id" value="<?= $fetch_orders['payment_data_id']; ?>">
         <select name="state" class="select">
            <option selected disabled><?= $fetch_orders['state']; ?></option>
            <option value="unpaid">unpaid</option>
            <option value="paid">paid</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="update" class="option-btn" name="update_payment">
         <a href="placed_orders.php?delete=<?= $fetch_orders['payment_data_id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>

</div>

</section>

</section>












<script src="../js/admin_script.js"></script>
   
</body>
</html>