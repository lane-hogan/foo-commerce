<?php
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM categories');
$categories = $result->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Categories -->
    <h1>Categories</h1>
    <?php foreach ($categories as $category) : ?>
        <h3><a href="categories.php?category_ID=<?= $category['category_ID']; ?>"><?= $category['name']; ?></a></h3>

    <?php endforeach;
    // Displays a selected category
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
        <?php endforeach; ?>
    <?php endif; ?>
    <a href="index.php"><b>HOME</b></a>
</body>

</html>