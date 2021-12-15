<?php
require_once('../settings.php');
require_once('../lib/db_util.php');


$result = DBHelper::query('SELECT * FROM products WHERE product_ID=?', [$_GET['product_ID']]); //getting product_id of the products to get the detail of the product
$product = $result->fetch();
?>

<html lang="en">
<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

<body>

        <div class="container" style="padding-top: 40px; padding-right: 45px; float: left">
            <h1>Product Detail</h1>
            <div class="card" style="margin-right: 830px; padding:5px; ">
                <img src="<?php echo $product["image"]; ?>" width="200" height="auto" style="padding-top: 10px" ">
                <div class="container">
                    <h1><?= $product['name'] ?></h1>
                    <label><b>Details:</b></label>
                    <p><?= $product['description'] ?></p>
                    <div class="product-price">
                        <label><?= "<b>Price</b>: $".$product["price"];?></label><br >
                        <a href="#" class="btn btn-primary">View Cart</a>
                    </div>
                </div>
            </div><br >
            <a href="categories.php"><b>Categories</b></a><br >
            <a href="index.php"><b>HOME</b></a>



    <script src="https://code.jquery.com/jquery-3.5 .1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>



