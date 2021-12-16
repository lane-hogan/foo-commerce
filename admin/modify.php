<?php
require_once('../auth/auth.php');

session_start();
$result = DBHelper::query('SELECT * FROM categories');
$categories = $result->fetchAll();
$status = 0;

//If the alter product form is submitted, the product is altered.
if (isset($_POST['product_ID'])){
    $result1 = DBHelper::query('SELECT * FROM products WHERE product_ID = ?', [$_POST['product_ID']]);
        //Checks to make sure product exists first
        if($result1->rowCount() == 0){
            $status = 2;
        } else {
            $status = 1;
            DBHelper::query("UPDATE products SET category_ID=?, image=?, description=?, price=?, name=? WHERE product_ID=?", [intval($_POST['category_ID']),$_POST['image'],$_POST['description'],$_POST['price'],$_POST['name'],$_POST['product_ID']]);
        }
}
//If the altered category form is submitted, the category is altered
if (isset($_POST['category_name'])){
    //*NOTE: The value of category name is technically category_ID
    $result1 = DBHelper::query('SELECT * FROM categories WHERE category_ID = ?', [$_POST['category_name']]);
        //Checks to make sure category exists first
        if($result1->rowCount() == 0){
            $status = 4;
        } else {
            $status = 3;
            DBHelper::query('UPDATE categories SET name=? WHERE category_ID=?', [$_POST['new_category_name'],$_POST['category_name']]);
        }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Admin Panel</title>
</head>

<body>
    <!--Status bar, appears after form submission-->
    <?php
        if ($status == 1) {?> <div class="alert alert-success" role="alert"><p>Product "<?=$_POST['product_ID']?>" Changed!</p></div> <?php }
        else if ($status == 2) {?> <div class="alert alert-danger" role="alert"><p>Product "<?=$_POST['product_ID']?>" Doesn't exist!</p></div> <?php } 
        else if ($status == 3) {?> <div class="alert alert-success" role="alert"><p>Category "<?=$_POST['category_name']?>" Changed!</p></div> <?php }
        else if ($status == 4) {?> <div class="alert alert-danger" role="alert"><p>Category "<?=$_POST['category_name']?>" Doesn't exist!</p></div> <?php } 
    ?>
 

    <!--Modify product form-->
    <div class="container mt-4 border border-secondary rounded p-4">
        <form action="modify.php" method="POST">
            <h5 class="display-5">Modify Product</h5>
            <div class="form-group">
                <label for="product_ID">ID Of product to be edited:</label>
                <input type="text" name="product_ID" placeholder="ID" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category_ID" id="category" placeholder="---" class="form-control" required>
                    <option>None</option>
                    <?php
                    foreach($categories as $category){ ?>
                        <option value="<?= $category['category_ID'] ?>"><?= $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="product_ID">Image Link:</label>
                <input type="text" name="image" placeholder="Image" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="product_ID">Description:</label>
                <input type="text" name="description" placeholder="Description" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="product_ID">Price:</label>
                <input type="text" name="price" placeholder="Price" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="product_ID">Product Name:</label>
                <input type="text" name="name" placeholder="Name" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-primary mt-4">Modify</button>
            <a href="delete.php" class="btn btn-secondary mt-4">Cancel</a>
        </form>
    </div>



    <!--Modify category form-->
    <div class="container mt-4 border border-secondary rounded p-4">
        <form action="modify.php" method="POST">
            <h5 class="display-5">Modify Category</h5>
            <div class="form-group">
                <label for="category">Category to be edited:</label>
                <select name="category_name" id="category" placeholder="---" class="form-control" required>
                    <option>None</option>
                    <?php
                    foreach($categories as $category){ ?>
                        <option value="<?= $category['category_ID'] ?>"><?= $category['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="category_ID">New Category name:</label>
                <input type="text" name="new_category_name" placeholder="name" class="form-control" required />
            </div>
            <button type="submit" class="btn btn-primary mt-4">Modify</button>
            <a href="delete.php" class="btn btn-secondary mt-4">Cancel</a>
        </form>
    </div>



<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>