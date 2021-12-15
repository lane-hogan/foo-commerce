<?php
$title = 'Foo Commerce';
require_once('../theme/header.php');
require_once('../settings.php');
// require_once('../lib/db_util.php');

session_start();

$result = DBHelper::query('SELECT * FROM products');
?>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php" style="margin-left: 15px"><b>FOO-COMMERCE</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php"><b>Home</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php"><b>Categories</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php"><b>Orders</b></a>
                </li>
                <?php if (!isset($_SESSION['is_logged'])) : ?>
                    <li class="nav-item">
                        <a href="../auth/sign_in.php" class="btn btn-primary" style="margin-left: 1150px; ">Sign In</a><br>
                    </li>
                    <li class="nav-item">
                        <a href="../auth/sign_up.php" class="btn btn-primary" style="margin-left: 20px;">Sign Up</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a href="../auth/sign_out.php" class="btn btn-primary" style="margin-left: 20px;">Sign Out</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </nav>
    <?php
    $result = DBHelper::query('SELECT * FROM products');

    while ($product = $result->fetch()) : ?>
        <div class="col-md-3" style=" padding:10px; margin-left: 15px; margin-top: 10px; display: flex">
            <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                <img src="<?= $product["image"]; ?>" width="300" alt="">
            </a>
            <div class="container" style="padding-left: 20px">
                <h1><?= $product['name'] ?></h1>
                <div class="product-price">
                    <label><?= "<b>Price</b>: $" . $product["price"]; ?></label>
                    <br>
                    <a href="orders.php" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>