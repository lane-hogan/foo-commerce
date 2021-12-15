<?php
require_once('../auth/auth.php');

session_start();
$result = DBHelper::query('SELECT * FROM categories');
$status = 0;

//If the new product form is submitted, the product is created.
if (isset($_POST['product_name'])) {
    $status = 1;
    DBHelper::insert('INSERT INTO products(category_ID, image, description, price, name) VALUES(?, ?, ?, ?, ?)',[$_POST['category'],$_POST['image'],$_POST['description'],$_POST['price'],$_POST['product_name']]);
}
//If the new category form was submitted, checks if the category already exists. If not, it is created.
else if (isset($_POST['category_name'])) {
    while($category=$result -> fetch()) {
        if ($category['name'] == $_POST['category_name']) {
            $status = 3;
        }
    }
    if ($status != 3) { 
        DBHelper::insert('INSERT INTO categories(name) VALUES(?)',[$_POST['category_name']]);
        $status = 2;
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
        if ($status == 1) {?> <div class="alert alert-success" role="alert"><p>Product "<?=$_POST['product_name']?>" created!</p></div> <?php }
        else if ($status == 2) {?> <div class="alert alert-success" role="alert"><p>Category "<?=$_POST['category_name']?>" created!</p></div> <?php }
        else if ($status == 3) {?> <div class="alert alert-danger" role="alert"><p>Category "<?=$_POST['category_name']?>" already exists!</p></div> <?php } 
    ?>
 

    <!--Create product form-->
    <div class="container mt-4 border border-secondary rounded p-4">
        <form action="create.php" method="POST">
            <h5 class="display-5">New Product</h5>
            <div class="form-group">
                <label for="product_name">Name:</label>
                <input type="text" name="product_name" placeholder="Product name" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" rows="2" maxlength="300" class="form-control" ></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="text" name="image" placeholder="Image URL" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" min="0.01" step="any" name="price" placeholder="0.00" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category" placeholder="---" class="form-control" required >
                    <option>None</option>                    
                    <?php
                    while($category=$result -> fetch()){?>
                    <option value="<?=$category['category_ID']?>"><?=$category['name']?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Create</button>
            <a href="create.php" class="btn btn-secondary mt-4">Cancel</a>
        </form>
    </div>



    <!--Create category form-->
    <div class="container mt-4 border border-secondary rounded p-4">
        <form action="create.php" method="POST">
            <h5 class="display-5">New Category</h5>
            <div class="form-group">
                <label for="category_name">Name:</label>
                <input type="text" name="category_name" placeholder="Category name" class="form-control" required />
            </div>
            
            <?php
            $result = DBHelper::query('SELECT * FROM categories');
            while($category=$result -> fetch())?>
            <button type="submit" class="btn btn-primary mt-4">Create</button>
            <a href="create.php" class="btn btn-secondary mt-4">Cancel</a>
        </form>
    </div>



<!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>