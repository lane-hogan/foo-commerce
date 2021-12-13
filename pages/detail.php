<?php
require_once('../settings.php');
require_once('../lib/db_util.php');


$result = DBHelper::query('SELECT * FROM products WHERE product_ID=?', [$_GET['product_ID']]);
$product = $result->fetch();
?>

<html lang="en">
<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

<body>
    <div class="left-column">
        <img src="<?php echo $product["image"]; ?>" width="200" height="auto">
    </div>

    <div class="right-column">
        <div class="product-description">
            <label>Product Name</label>
            <h1><?= $product['name'] ?></h1>
            <label>Product Description</label>
            <p><?= $product['description'] ?></p>
        </div>

        <div class="product-price">
            <span><?= $product['price'] ?></span>
            <a href="#" class="cart-btn">Add to cart</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5 .1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <a href="../index.php"><b>HOME</b></a>
</body>