<?php session_start(); ?>

//This file acts as a headers for all other pages, providing a navigation bar. This page also displays certain actions and buttons 
//based on user attributes (i.e. if they are an admin, if they are signed in, etc.).
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
    //Navigation bar.
   <nav class="p-2 navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../pages/index.php"><b>FOO-COMMERCE</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportContent" aria-controls="navbarSupportContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportContent">
            //Main navigation links.
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../pages/index.php">Home<span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/categories.php">Categories<span class="sr-only"></span></a>
                </li>
                //If users are not signed in, they are unable to access the orders page.
                <?php if (isset($_SESSION['is_logged'])) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="orders.php">Orders</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        //If the user is not logged in, the Sign In and Sign Up buttons are displayed.
        <?php if (!isset($_SESSION['is_logged'])) : ?>
            <div class="form-inline">
                <a href="../auth/sign_in.php" class="mr-sm-2 btn btn-primary">Sign In</a>
                <a href="../auth/sign_up.php" class="my-2 my-sm-0 btn btn-primary"">Sign Up</a>
            </div>
        //If the user is logged in, the Sign Out button is displayed in place of Sign In and Sign Up.
        <?php else : ?>
            <div class="form-inline">
                    <?php if(isset($_SESSION['is_admin'])) {
                        //If the user is an admin user, the Admin Tools button is displayed.
                        if($_SESSION['is_admin'] == 1){?>
                            <a href='../admin/admin.php' class="mr-sm-2 btn btn-warning">Admin Tools</a>
                    <?php }
                    } ?>
                <a href="../auth/sign_out.php" class="mr-sm-2 btn btn-danger">Sign Out</a>
            </div>            
        <?php endif; ?>
    </nav>