<?php
$title = 'Categories';
require_once('../theme/header.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM categories');
$categories = $result->fetchAll();
?>

<div style="padding-top: 30px; text-align: center">
    <h1 style="padding-bottom: 20px;">Categories</h1>
    
    <!-- Categories List-->
    <?php foreach ($categories as $category) : ?>
        <h3><a href="categories.php?category_ID=<?= $category['category_ID']; ?>"><?= $category['name']; ?></a></h3>
    <?php endforeach;
    if (isset($_GET['category_ID'])) : ?>
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
    <a href="index.php"><b>HOME</b></a>
</div>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>