<?php
require_once('../../settings.php');
require_once('../../lib/db_util.php');

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
<<<<<<< HEAD
    <?php while ($product = $result->fetch()) : ?>
        <div class="d-flex justify-content-center ">
            <div class="card p-2">
                <div class="flex align-items-center ">
                    <div class="mt-2">
                        <h4 class="text-uppercase">Foo</h4>
                        <div class="advisor_thumb"><a href="product_detail.php?product_ID=<?= $_GET['product_ID']; ?>"><img src="<?= $product["photo"]; ?>" alt=""></a>
                            <div class="mt-4">
                                <h1 class="main-heading mt-0"><?php echo $product["name"]; ?></h1>
                                <div class="price"> <?php echo "$" . $product["price"]; ?> </div>
                            </div>
                        </div>
                        <div class="image"> <img src="<?php echo $product["image"]; ?>" width="100"></div>
                    </div>
                    <button class="btn btn-primary" position="fixed" ; bottom="50px" ; right="10px" ;>Add to cart</button>
=======
<?php
require_once('../settings.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM products');
// print_r($result->fetchAll());

while($product=$result -> fetch()){
?>
<div class="d-flex justify-content-center ">
    <div class="card p-2">
        <div class="flex align-items-center ">
            <div class="mt-2">
                <h4 class="text-uppercase">Foo</h4>
                <div class="advisor_thumb"><a href="detail.php?product_ID=<?= $product['product_ID']; ?>"><img src="<?=$product["image"];?>" width="200" height="auto" alt=""></a>
                <div class="mt-4">
                    <h1 class="main-heading mt-0"><?php echo $product["name"];?></h1>
                    <div class="price"> <?php echo "$".$product["price"];?> </div>
>>>>>>> be9a1e021e48e4c745104381084f3b425d82a15d
                </div>
            </div>
        <?php endwhile ?>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>