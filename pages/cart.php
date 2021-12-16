<?php
require_once('../settings.php');
require_once('../lib/db_util.php');
session_start();

if(!empty($_SESSION['product_ID'])){
    $result = DBHelper::query('SELECT * FROM products WHERE product_ID=?', [$_GET['product_ID']]);
    $product =$result->fetch_assoc();

    //creating an index whose value is 1
    $index=0;
if(!isset($_SESSION['array'])){
    $_SESSION['array']=array_fill(0,count($_SESSION['product_ID']),1);
}

while($product){
    ?>
<tr>
    <td>
        href="cart.php?id=<?php echo $product['id']; ?>&index=<?php echo $index; ?>"
    </td>
    <td><?=$product['name'];?>
    </td>

    <td><?=$product['name'];?>
    </td>
</tr>


}

}



//add product to session or create new one


    //we need to get product name and price from database.


?>

<h2>Your Shopping Cart</h2>
<form method="POST" action="save_cart.php">
    <table class="table table-bordered table-striped">
        <thead>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </thead>



