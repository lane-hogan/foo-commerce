<!DOCTYPE html>
<html lang="en">
<?php 

require_once('../lib/db_util.php');

//SQL Query to get categories table data from the database
$result = DBHelper::query('SELECT * FROM categories');
$categories = $result->fetchAll();

?>
<body>
    <!--Loop That Prints out all the different avaiable categories-->
    <h1>Categories</h1>
    <?php foreach($categories as $category){ ?>
        <h3><a href="categories.php?category_ID=<?= $category['category_ID']; ?>"><?= $category['name']; ?></a></h3>

    <?php } 
        //Conditional that checks whether someone has clicked a specific category then it displays that category
        if(isset($_GET['category_ID'])){?>
           <h1><?=$categories[$_GET['category_ID']-1]['name']?></h1>
           <?php 
           $products = DBHelper::query('SELECT * FROM products WHERE `category_ID` = ?', [$_GET['category_ID']]);
           $products = $products->fetchAll();
           foreach($products as $product){?>
                </br></br><h2><a href="products/product_detail.php?=<?=$product['product_ID']?>"><?= $product['name'] ?></br><img src="<?=$product['image']?>" width="300" height="auto"></a></h2>
          <?php } ?>
    <?php } ?>
    
</body>
</html>