<!DOCTYPE html>
<html lang="en">
<?php
require_once("../lib/db_util.php");

session_start();
//Finds all the different orders associated with one user
$result = DBHelper::query('SELECT * FROM `user-order` WHERE `user_ID` = ?', [$_SESSION['user-id']]);
$orders = $result->fetchAll();
?>
<body>
<?php
//First Loop is to loop through all of the users' current orders
foreach($orders as $order){
    $order_ID = $order['order_ID'];
    $orderProducts = DBHelper::query('SELECT * FROM `order-product` WHERE `order_ID` = ?', [$order_ID]);
    ?>
    <h2><?php echo "Order #:"." ".$order_ID; ?></h2>
    <!--Second Loop is for finding product IDs associated with the current order and listing them-->
    <?php foreach($orderProducts as $orderProduct){ 
        $count = 0;
        $product_ID = $orderProduct['product_ID'];
        $temp1 = DBHelper::query('SELECT * FROM `products` WHERE `product_ID` = ?', [$product_ID]);
        $productName = $temp1->fetchAll(); ?>
        <h5><?= "Product Name:"." ".$productName[$count]['name']; ?></h5>
        <?php $count++ ?>
    <?php } ?>
<?php } ?>
</body>
</html>