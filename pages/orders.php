<?php
$title = 'Orders';
require_once('../theme/header.php');
require_once("../lib/db_util.php");

//If the user is not logged in, redirect to the home page.
if(!isset($_SESSION['user-id'])) header('Location: index.php');

//If "Remove Item" selected, item is removed (removes orders-users and orders-products entries).
if(isset($_GET['delete'])) {
    DBHelper::insert('DELETE FROM `orders-products` WHERE order_id = ? AND product_id = ? LIMIT 1;', [$_GET['order'], $_GET['product']]);
}

//Queries the highest-numbered order_ID associated with the logged in user.
$orderNum = DBHelper::query('SELECT `order_id` FROM `users-orders` WHERE `user_id` = ? ORDER BY `order_id` DESC LIMIT 1;', [$_SESSION['user-id']]);

//If the user does not have any orders, create a new order and order-user association.
if ($orderNum->rowCount() == 0) {
    DBHelper::insert('INSERT INTO orders(order_id, status) VALUES("","");');
    //Re-finds the highest-numbered order_ID (should be the newly-created order_id).
    $orderNum = DBHelper::query('SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1;');
    $orderNum = $orderNum->fetch();
    //Creates order-user association.
    DBHelper::insert('INSERT INTO `users-orders`(`order_id`, `user_id`) VALUES(?, ?);', [$orderNum['order_id'], $_SESSION['user-id']]);
    //Re-finds the highest-numbered order_ID associated with the logged in user (this is the newly-created order).
    $orderNum = DBHelper::query('SELECT `order_id` FROM `users-orders` WHERE `user_id` = ? ORDER BY `order_id` DESC LIMIT 1;', [$_SESSION['user-id']]);
}
//Creates array from the PDO object so order_id is accessible. 
$orderNum = $orderNum->fetch();

//Queries the data is_completed for the highest-numbered order_ID.
$isComplete = DBHelper::query('SELECT `is_completed` FROM `orders` WHERE `order_id` = ?;', [$orderNum['order_id']]);
$isComplete = $isComplete->fetch();

//If the highest-numbered order_ID has is_completed == 0 and the user is adding a product, make the order-product association.
if ($isComplete['is_completed'] == '0' && isset($_GET['product_id'])) {
    DBHelper::insert('INSERT INTO `orders-products`(order_id, product_id) VALUES(?, ?)',[$orderNum['order_id'], $_GET['product_id']]); 
}
//If the highest-numbered order_ID has completed == 1, create new order and make user-order and order-product associations.
if ($isComplete['is_completed'] == '1') {
    DBHelper::insert('INSERT INTO orders(order_id, status) VALUES("","");');
    //Re-finds the highest-numbered order_ID associated with the logged in user (this is the newly-created order).
    $orderNum = DBHelper::query('SELECT `order_id` FROM `orders` ORDER BY `order_id` DESC LIMIT 1;');
    $orderNum = $orderNum->fetch();
    //If the user is adding a product, make the user-order and order-product associations.
    if (isset($_GET['product_id'])) {
        DBHelper::insert('INSERT INTO users-orders(order_id, user_id) VALUES(?, ?)',[$orderNum['order_id'],$_SESSION['user-id']]); 
        DBHelper::insert('INSERT INTO orders-products(order_id, product_id) VALUES(?, ?)',[$orderNum['order_id'],$_GET['product_id']]);
    }
}

//Now that products are added to the order, queries all of the order-product associations.
$currentOrder = DBHelper::query('SELECT * FROM `orders-products` WHERE `order_id` = ?', [$orderNum['order_id']]);

//If the user does not have any products in their order, displays a message.
if ($currentOrder->rowCount() == 0) {
    ?><h4 style="padding: 40px; text-align: center; color: #999999"><i>There are no products in your cart.</i></h4><?php
}
//If the user has products in their order, displays the products.
if (!$currentOrder->rowCount() == 0) {
    //Creates array from the PDO object so values are accessbile.
    $currentOrder = $currentOrder->fetchAll();
    //Order header. ?>
    <div style="padding-top: 30px; padding-right: 10%; padding-left: 10%;">
        <h1 style="padding-bottom: 20px;">Orders:</h1>
    </div><hr/>
    <?php //Product card. ?>
    <div class=" container mt-4">
        <div class="row" style="margin: 0 auto;"><?php
            //Loops through each orders-products associations in the user's current order.
            foreach ($currentOrder as $orderProduct) :
                $product = DBHelper::query('SELECT * FROM `products` WHERE `product_id` = ?', [$orderProduct['product_ID']]);
                $product = $product->fetch();
                ?>      
                <div class="col-md-4" style="padding-bottom: 30px;">
                    <div class="card border border-dark" style="width: 20rem;">
                        <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                            <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
                        </a>
                        <hr/>
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text"><?= "$" . $product["price"]; ?></p>
                            <a href="orders.php?delete=true&product=<?=$product['product_ID']?>&order=<?=$orderProduct['order_ID']?>" class="btn btn-danger">Remove Item</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php 
} ?>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>