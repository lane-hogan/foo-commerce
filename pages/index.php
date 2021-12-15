<?php
require_once('../settings.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM products');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Foo Commerce</title>
</head>

<body>

<h1>Products</h1>
<?php
require_once('../settings.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM products');
// print_r($result->fetchAll());

while($product=$result -> fetch()){
?>
        <div class="col-md-3" style=" padding:10px; margin-left: 10px; margin-top: 10px; display: flex">
            <a href="detail.php?product_ID=<?= $product['product_ID']; ?>"><img src="<?=$product["image"];?>" width="300"  alt=""></a>
            <div class="container" style="padding-left: 20px">
                <h1><?= $product['name'] ?></h1>
                <div class="product-price">
                    <label><?= "<b>Price</b>: $".$product["price"];?></label><br >
                    <a href="#" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div><br >
    <?php

}
?>
<a href="../index.php"><b>HOME</b></a>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>





