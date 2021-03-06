<?php
$title = 'Admin Tools';
require_once('../theme/header.php');
require_once('../auth/auth.php');

if(!isset($_SESSION['is_admin'])) header("Location:../pages/index.php");
$result = DBHelper::query('SELECT * FROM categories');
$status = 0;

//If the delete product form is submitted, the product is deleted.
if (isset($_POST['product_ID'])){
    $result1 = DBHelper::query('SELECT * FROM products WHERE product_ID = ?', [$_POST['product_ID']]);
        //Checks to make sure product exists first
        if($result1->rowCount() == 0){
            $status = 2;
        } else {
            $status = 1;
            $result2 = DBHelper::query('SELECT * FROM `order-product` WHERE product_ID = ?', [$_POST['product_ID']]);
            $orderProducts = $result2->fetchAll();
            print_r($orderProducts);
            $orders = [];
            //Loop that gets the necessary orders that need to be deleted from the orders table
            foreach($orderProducts as $orderProduct){
                $orders[] = $orderProduct['order_ID'];
            }
            //Loop that deletes the necessary elements from the orders table
            DBHelper::query('DELETE FROM products WHERE product_ID = ?', [$_POST['product_ID']]);
            foreach($orders as $order){
                DBHelper::query('DELETE FROM orders WHERE order_ID = ?', [$order]);
                DBHelper::query('DELETE FROM `user-order` WHERE order_ID = ?', [$order]);
            }
        }
}
//Checks if category exists before deleting it
if (isset($_POST['category_ID'])){
    $result1 = DBHelper::query('SELECT * FROM categories WHERE category_ID = ?', [$_POST['category_ID']]);
        //Checks to make sure the category exists first
        if($result1->rowCount() == 0){
            $status = 4;
        } else {
            $status = 3;
            DBHelper::query('DELETE FROM categories WHERE category_ID = ?', [$_POST['category_ID']]);
        }
}
?>

<!--Status bar, appears after form submission-->
<?php
    switch ($status):
        case 1: ?>
            <div class="alert alert-success" role="alert">
                <p>Product "<?= $_POST['product_ID']; ?>" deleted!</p>
            </div>
            <?php break; ?>
        <?php
        case 2: ?>
            <div class="alert alert-danger" role="alert">
                <p>Product "<?= $_POST['product_ID']; ?>" doesn't exist!</p>
            </div>
            <?php break; ?>
        <?php
        case 3: ?>
            <div class="alert alert-success" role="alert">
                <p>Category "<?= $_POST['category_ID']; ?>" deleted!</p>
            </div>
            <?php break; ?>
        <?php
        case 4: ?>
            <div class="alert alert-danger" role="alert">
                <p>Category "<?= $_POST['category_ID']; ?>" doesn't exist!</p>
            </div>
            <?php break; ?>
    <?php endswitch; ?>


<!--Delete product form-->
<div class="container mt-4 border border-secondary rounded p-4">
    <form action="delete.php" method="POST">
        <h5 class="display-5">Delete Product</h5>
        <div class="form-group">
            <label for="product_ID">Product ID:</label>
            <input type="text" name="product_ID" placeholder="ID" class="form-control" required />
        </div>
        <button type="submit" class="btn btn-danger mt-4">Delete</button>
        <a href="delete.php" class="btn btn-secondary mt-4">Cancel</a>
    </form>
</div>

<!--Delete category form-->
<div class="container mt-4 border border-secondary rounded p-4">
    <form action="delete.php" method="POST">
        <h5 class="display-5">Delete Category</h5>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category_ID" id="category" placeholder="---" class="form-control" required>
                <option>None</option>
                <?php
                while ($category = $result->fetch()) : ?>
                    <option value="<?= $category['category_ID'] ?>"><?= $category['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger mt-4">Delete</button>
        <a href="delete.php" class="btn btn-secondary mt-4">Cancel</a>
    </form>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>