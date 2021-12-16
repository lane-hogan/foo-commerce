<?php
require_once("../lib/db_util.php");
session_start();
if(!isset($_SESSION['user-id'])) header('Location: index.php');
//Finds all the different orders associated with one user
$result = DBHelper::query('SELECT * FROM `users-orders` WHERE user_ID = ?', [$_SESSION['user-id']]);
$orders = $result->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<body>

<?php

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

<nav class="p-2 navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><b>FOO-COMMERCE</b></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupportContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home<span class="sr-only"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="categories.php">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
            </li>
        </ul>
    </div>
    <?php if (!isset($_SESSION['is_logged'])) : ?>
        <div class="form-inline">
            <a href="../auth/sign_in.php" class="mr-sm-2 btn btn-primary">Sign In</a>
            <a href="../auth/sign_up.php" class="my-2 my-sm-0 btn btn-primary"">Sign Up</a>
        </div>
    <?php else : ?>
        <li class="nav-item">
            <a href="../auth/sign_out.php" class="btn btn-primary"">Sign Out</a>
        </li>
    <?php endif; ?>
</nav>

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

</body>
</html>




