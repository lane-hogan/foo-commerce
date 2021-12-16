<?php
$title = 'Admin Tools';
require_once('../theme/header.php');
require_once('../auth/auth.php');
?>
<!--Administrative buttons that link to their respective pages-->
<div style="padding-top: 100px; text-align: center">
    <h1 style="padding-bottom: 20px;">Administration Tools</h1>
    <a href="create.php" class="btn btn-primary">Create</a>
    <a href="modify.php" class="btn btn-warning">Modify</a>
    <a href="delete.php" class="btn btn-danger">Delete</a>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-PsUw7Xwds7x08Ew3exXhqzbhuEYmA2xnwc8BuD6SEr+UmEHlX8/MCltYEodzWA4u" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>