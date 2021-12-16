<?php
$title = 'Sign Up';
require_once('../theme/header.php');
require_once('../auth/auth.php');

if (is_logged()) header('Location: ../quotes/index.php');
if (count($_POST) > 0) :
    $result = sign_up($_POST['email'], $_POST['password'], $_POST['fname'], $_POST['lname']);
    if ($result['status'] == 1) header('Location: sign_in.php');
endif; 
?>

<!-- Sign up form -->
<div class="container mt-4 border border-secondary rounded p-4">
    <?php if (isset($result)) : ?>
        <div class="alert alert-<?= $result['status'] == -1 ? "danger" : "success" ?>" role="alert">
            <?= $result['message']; ?>
        </div>
    <?php endif; ?>

    <form action="sign_up.php" method="POST">
        <h4 class="display-4">Sign up</h4>
        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" placeholder="First name" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" placeholder="Last name" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Enter email" class="form-control" required />
        </div>
        <div class="form-group mt-4">
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter password" class="form-control" minlength="8" required>
        </div>
        <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
</div>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>