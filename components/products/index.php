<?php
require_once('../settings.php');
require_once('../auth/auth.php');

session_start();

$result = DBHelper::query('SELECT * FROM products');
while($var = $result -> fetch())
    print_r($var('name'))

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
<div class="height d-flex justify-content-center align-items-center">
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center ">
            <div class="mt-2">
                <h4 class="text-uppercase">Foo</h4>
                <div class="mt-5">
                    <h5 class="text-uppercase mb-0"></h5>
                    <h1 class="main-heading mt-0">PENCIL</h1>
                </div>
            </div>
            <div class="image"> <img src="https://i.imgur.com/MGorDUi.png" width="200"> </div>
        </div>
        <button class="btn btn-danger">Add to cart</button>
    </div>
</div>


<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>

</html>