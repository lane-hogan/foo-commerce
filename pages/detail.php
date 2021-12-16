<?php
$title = 'Product Details';
require_once('../theme/header.php');
require_once('../settings.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM products WHERE product_ID=?', [$_GET['product_ID']]);
$product = $result->fetch(); ?>

<!--Displays product details-->
<div class="container mt-4 d-flex justify-content-center">
    <div class="card border border-dark" style="width: 20rem;">
        <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
            <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
        </a>
        <hr/>
        <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?></h5>
            <p><?= $product['description']; ?></p>
            <p class="card-text"><?= "$" . $product["price"]; ?></p>
            <!--Conditional Used to check if user is logged in-->
            <?php if(!isset($_SESSION['user-id'])) { ?>
                <a href="../auth/sign_up.php" class="btn btn-primary">Add to Cart</a>
            <?php }
            else { ?>
                <a href="orders.php?product_id=<?= $product['product_ID'] ?>" class="btn btn-primary">Add to Cart</a> 
            <?php } ?>
        </div>
    </div>
</div>

<!--Bootstrap-->
<script src="https://code.jquery.com/jquery-3.5 .1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>