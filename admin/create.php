<?php
$title = 'Admin Tools';
require_once('../theme/header.php');
require_once('../auth/auth.php');

$result = DBHelper::query('SELECT * FROM categories');
$status = 0;

//If the new product form is submitted, the product is created.
if (isset($_POST['product_name'])) {
    $status = 1;
    DBHelper::insert('INSERT INTO products(category_ID, image, description, price, name) VALUES(?, ?, ?, ?, ?)', [$_POST['category'], $_POST['image'], $_POST['description'], $_POST['price'], $_POST['product_name']]);
} else if (isset($_POST['category_name'])) {
    //If the new category form was submitted, checks if the category already exists. If not, it is created.
    while ($category = $result->fetch()) {
        if ($category['name'] == $_POST['category_name']) {
            $status = 3;
        }
    }
    if ($status != 3) {
        DBHelper::insert('INSERT INTO categories(name) VALUES(?)', [$_POST['category_name']]);
        $status = 2;
    }
} ?>

<!-- Status bar, appears after form submission -->
<?php switch ($status):
    case 1: ?>
        <div class="alert alert-success" role="alert">
            <p>Product "<?= $_POST['product_name']; ?>" created!</p>
        </div>
    <?php break; 
    case 2: ?>
        <div class="alert alert-success" role="alert">
            <p>Category "<?= $_POST['category_name']; ?>" created!</p>
        </div>
    <?php break;
    case 3: ?>
        <div class="alert alert-danger" role="alert">
            <p>Category "<?= $_POST['category_name']; ?>" already exists!</p>
            </div>
<?php endswitch; ?>

<!--Create product form-->
<div class="container mt-4 border border-secondary rounded p-4">
    <form action="create.php" method="POST">
        <h5 class="display-5">New Product</h5>
        <!--Name-->
        <div class="form-group">
            <label for="product_name">Name:</label>
            <input type="text" name="product_name" placeholder="Product name" class="form-control" required />
        </div>
        <!--Description-->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" rows="2" maxlength="300" class="form-control"></textarea>
        </div>
        <!--Image-->
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="text" name="image" placeholder="Image URL" class="form-control" required />
        </div>
        <!--Price-->
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" min="0.01" step="any" name="price" placeholder="0.00" class="form-control" required />
        </div>
        <!--Category-->
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" placeholder="---" class="form-control" required>
                <option>None</option>
                <!--Loop that provides a drop down list of all the categories for the user to pick-->
                <?php
                while ($category = $result->fetch()) : ?>
                    <option value="<?= $category['category_ID'] ?>"><?= $category['name'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <!--Submit and Cancel Buttons-->
        <button type="submit" class="btn btn-primary mt-4">Create</button>
        <a href="create.php" class="btn btn-secondary mt-4">Cancel</a>
    </form>
</div>

<!--Create category form-->
<div class="container mt-4 border border-secondary rounded p-4">
    <form action="create.php" method="POST">
        <!--New Category-->
        <h5 class="display-5">New Category</h5>
        <div class="form-group">
            <label for="category_name">Name:</label>
            <input type="text" name="category_name" placeholder="Category name" class="form-control" required />
        </div>
        <!--Query that gets all rows from the categories table-->
        <?php 
            $result = DBHelper::query('SELECT * FROM categories');
            while ($category = $result->fetch()) 
        ?>
        <button type="submit" class="btn btn-primary mt-4">Create</button>
        <a href="create.php" class="btn btn-secondary mt-4">Cancel</a>
    </form>
</div>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>