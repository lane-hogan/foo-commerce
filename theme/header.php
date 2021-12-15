<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title><?= $title; ?></title>
</head>

<body>
</body>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a class="navbar-brand" href="index.php">FOO-COMMERCE</a>
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