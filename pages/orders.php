<?php
$title = 'Orders';
require_once('../theme/header.php');
require_once("../lib/db_util.php");


if(!isset($_SESSION['user-id'])) header('Location: index.php');
//Finds all the different orders associated with one user
$result = DBHelper::query('SELECT * FROM `users-orders` WHERE user_ID = ?', [$_SESSION['user-id']]);
$orders = $result->fetchAll();


//First Loop is to loop through all of the users' current orders
foreach ($orders as $order) {
    $order_ID = $order['order_ID'];
    $orderProducts = DBHelper::query('SELECT * FROM `order-product` WHERE `order_ID` = ?', [$order_ID]);
    ?>
    <h2><?= "Order #: " . $order_ID; ?></h2>
    <!--Second Loop is for finding product IDs associated with the current order and listing them-->
    <?php foreach ($orderProducts as $orderProduct) {
        $count = 0;
        $product_ID = $orderProduct['product_ID'];
        $temp1 = DBHelper::query('SELECT * FROM `products` WHERE `product_ID` = ?', [$product_ID]);
        $productName = $temp1->fetchAll(); ?>
        <h5><?= "Product Name: ". $productName[$count]['name']; ?></h5>
        <?php $count++ ?>
    <?php }
} ?>


<?php
    //First Loop is to loop through all of the users' current orders
    foreach ($orders as $order) :
        $order_ID = $order['order_ID'];
        $orderProducts = DBHelper::query('SELECT * FROM `order-product` WHERE `order_ID` = ?', [$order_ID]);
    ?>
        <h2><?= "Order #: " . $order_ID; ?></h2>
        <?php foreach ($orderProducts as $orderProduct) :
            $count = 0;
            $product_ID = $orderProduct['product_ID'];
            $temp = DBHelper::query('SELECT * FROM `products` WHERE `product_ID` = ?', [$product_ID]);
            $productName = $temp1->fetchAll(); ?>
            <h5><?= "Product Name: " . $productName[$count]['name']; ?></h5>
            
            
            <?php $count++ ?>
        <?php endforeach; ?>
    <?php endforeach; ?>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>