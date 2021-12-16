<?php
$title = 'Categories';
require_once('../theme/header.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM categories');
$categories = $result->fetchAll();
?>

<div style="padding-top: 30px; padding-right: 10%; padding-left: 10%;">
    <h1 style="padding-bottom: 20px; text-align: center;">Categories</h1>
    
    <!-- Categories List-->
    <?php foreach ($categories as $category) : ?>
        <div class="form-inline" style="display: inline-block;">
            <a href="categories.php?category_ID=<?= $category['category_ID']; ?>" class="mr-sm-2 btn btn-primary"><?= $category['name']; ?></a>
        </div>
    <?php endforeach; ?>
</div><hr/>

<?php if (isset($_GET['category_ID'])) : ?>
    <div class=" container mt-4">
        <div class="row" style="margin: 0 auto;">
            <?php while ($product = $result->fetch()) : ?>
                <div class="col-md-4" style="padding-bottom: 30px;">
                    <div class="card border border-dark" style="width: 20rem;">
                        <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                            <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
                        </a>
                        <hr/>
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text"><?= "$" . $product["price"]; ?></p>
                            <a href="orders.php" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <?php if (isset($_GET['category_ID'])) : ?>
        <h1><?= $categories[$_GET['category_ID'] - 1]['name'] ?></h1>
        <?php
        $products = DBHelper::query('SELECT * FROM products WHERE `category_ID` = ?', [$_GET['category_ID']]);
        $products = $products->fetchAll();
        foreach ($products as $product) : ?>
            <br /><br />
            <h2>
                <a href="detail.php?product_ID=<?= $product['product_ID'] ?>"><?= $product['name'] ?>
                    </br>
                    <img src="<?= $product['image'] ?>" width="300" height="auto">
                </a>
            </h2>
        <?php endforeach;
    endif; ?>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>