<?php
require_once('../settings.php');
require_once('../lib/db_util.php');
session_start();

$result = DBHelper::query('SELECT * FROM products WHERE product_ID=?', [$_GET['product_ID']]);
$product = $result->fetch();
?>

<html lang="en">
<!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />

<body>
    <nav class="p-2 navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php"><b>FOO-COMMERCE</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupportContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <li class="nav-item">
                    <a href="../auth/sign_out.php" class="btn btn-primary"">Sign Out</a>
                </li>
            <?php endif; ?>
        </nav>


        <div class="container mt-4 d-flex justify-content-center">
            <div class="card border border-dark" style="width: 20rem;">
                <a href="detail.php?product_ID=<?= $product['product_ID']; ?>">
                    <img class="p-2 card-img-top" src="<?= $product["image"]; ?>" alt="product_image" width="286" height="230" alt="">
                </a><hr/>
                    <div class="card-body">
                    <h5 class="card-title"><?= $product['name'] ?></h5>
                    <p><?= $product['description']; ?></p>
                    <p class="card-text"><?= "$" . $product["price"]; ?></p>
                    <a href="orders.php" class="btn btn-primary">Add to Cart</a>
                </div>
            </div>
        </div>
  
    <script src="https://code.jquery.com/jquery-3.5 .1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>