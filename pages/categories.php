<?php
$title = 'Categories';
require_once('../theme/header.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM categories');
$categories = $result->fetchAll();
?>

<div style="padding-top: 30px; padding-right: 10%; padding-left: 10%;">
    <h1 style="padding-bottom: 20px;">Categories</h1>
    
    <!-- Categories List-->
    <?php foreach ($categories as $category) : ?>
        <div class="form-inline" style="display: inline-block;">
            <a href="categories.php?category_ID=<?= $category['category_ID']; ?>&name=<?= $category['name']?>" class="mr-sm-2 btn btn-primary"><?= $category['name']; ?></a>
        </div>
    <?php endforeach; ?>
</div><hr/>

<?php if (isset($_GET['category_ID'])) : ?>
    <h2 style="text-align: center;"><?= $_GET['name']?></h2>
    <?php $products = DBHelper::query('SELECT * FROM products WHERE `category_ID` = ?', [$_GET['category_ID']]);
    if ($products->rowCount() == 0) : ?>
        <h4 style="text-align: center; color: #999999"><i>There are no products in this category.</i></h4>
    <?php endif;
        $products = $products->fetchAll(); ?>
        <div class=" container mt-4">
            <div class="row" style="margin: 0 auto;">
                <?php foreach ($products as $product) : ?>
                    <div class="col-md-4" style="padding-bottom: 30px;">
                        <div class="card border border-dark" style="width: 20rem;">
                            <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                                <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
                            </a>
                            <hr/>
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['name'] ?></h5>
                                <p class="card-text"><?= "$" . $product["price"]; ?></p>
                                <?php if(!isset($_SESSION['user-id'])) { ?>
                                    <a href="../auth/sign_up.php" class="btn btn-primary">Add to Cart</a>
                                <?php }
                                else { ?>
                                    <a href="orders.php?product_id=<?= $product['product_ID'] ?>" class="btn btn-primary">Add to Cart</a> 
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
<?php endif; ?>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>