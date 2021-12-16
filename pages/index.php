<?php
$title = 'Foo Commerce';
require_once('../theme/header.php');
require_once('../settings.php');
require_once('../lib/db_util.php');

session_start();

$result = DBHelper::query('SELECT * FROM products');
?>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php" style="margin-left: 15px"><b>FOO-COMMERCE</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Orders</a>
                </li>
            </ul>
        </div>
        <?php if (!isset($_SESSION['is_logged'])) : ?>
            <div class="form-inline">
                <a href="../auth/sign_in.php" class="mr-sm-2 btn btn-primary">Sign In</a>
                <a href="../auth/sign_up.php" class="my-2 my-sm-0 btn btn-primary"">Sign Up</a>
            </div>
                <?php else : ?>
                    <li class=" nav-item">
                     <a href="../auth/sign_out.php" class="btn btn-primary"">Sign Out</a>
                    </li>
                <?php endif; ?>
    </nav>

    <?php
    $result = DBHelper::query('SELECT * FROM products'); ?>
    <div class=" container mt-4">
        <div class="row" style="margin: 0 auto;">
            <?php while ($product = $result->fetch()) : ?>
                <div class="col-md-4" style="padding-bottom: 30px;">
                    <div class="card border border-dark" style="width: 20rem;">
                        <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                            <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
                        </a>
                        <hr />
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['name'] ?></h5>
                            <p class="card-text"><?= "$" . $product["price"]; ?></p>
                            <a href="orders.php" class="btn btn-primary">Add to Cart</a>
                        </div>

     $result = DBHelper::query('SELECT * FROM products'); ?>
     <div class=" container mt-4">
        <div class="row" style="margin: 0 auto;">
            <?php while ($product = $result->fetch()) : ?>
                <div class="col-md-4" style="padding-bottom: 30px;">
                    <div class="card border border-dark" style="width: 20rem;">
                        <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                            <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
                        </a>
                        <hr />
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


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
