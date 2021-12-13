<!DOCTYPE html>
<html lang="en">
<?php
require_once("../lib/db_util.php");

session_start();
$user_ID = $_SESSION['user-id'] ;
print_r($user_ID);

$result = DBHelper::query('SELECT * FROM `user-order` WHERE `user_ID` = 1');
echo '<pre>';
$userOrders = $result->fetchAll();
print_r($userOrders);
?>
<body>
<?php
foreach($userOrders as $order){
    $order_ID = $order['order_ID'];
    ?>
    <h2><?php echo "Order #:"." ".$order_ID; ?></h2>
    <?php foreach(){ 
        
    }?>
<?php } ?>
</body>
</html>