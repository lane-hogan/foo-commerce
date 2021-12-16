<?php
$title = 'Foo Commerce';
require_once('../theme/header.php');
require_once('../settings.php');
require_once('../lib/db_util.php');

$result = DBHelper::query('SELECT * FROM products'); ?>

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

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body> 
</html>