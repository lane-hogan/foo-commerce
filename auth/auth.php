<?php
require_once('../lib/db_util.php');
/**
 * Signs a user up using a CSV file.
 * Encrypts password to prevent it from being
 * insecure.
 * 
 * @param string $email email address
 * @param string $password password
 * @return array status code and error message
 */
function sign_up($email, $password)
{
    // Check if the fields are empty
    if (!isset($email))
        return ['status' => -1, 'message' => 'Please enter your email'];
    if (!isset($password))
        return ['status' => -1, 'message' => 'Please enter your email'];

    // Check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return ['status' => -1, 'message' => 'Your email is invalid'];

    // Check if password length is between 8 characters
    if (strlen($password) < 8)
        return ['status' => -1, 'message' => 'Please enter a password >=8 characters'];

    // Check if the password contains at least 2 special characters
    if (!preg_match_all('/[£$%^&*#@]/', $password) >= 2)
        return ['status' => -1, 'message' => 'Your password should contain at least 2 special characters.'];

    // Check if the email is in the database already
    $result = DBHelper::query('SELECT * FROM users WHERE email = ?', [$_POST['email']]);
    if ($result->rowCount() > 0)
        return ['status' => -1, 'message' => 'User exists!'];

    // Save user in database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    DBHelper::insert(
        'INSERT INTO users(email, password, isAdmin) VALUES(?, ?, 0)',
        [$_POST['email'], $hashedPassword]
    );

    return ['status' => 1, 'message' => 'You have been registered!'];
}

/**
 * Signs a user into a webpage.
 * 
 * @param string $email email address
 * @param string $password password
 * @return array array with an error code and an error message
 */
function sign_in($email, $password)
{
    if (!isset($email)) ['status' => -1, 'message' => 'Please enter your email'];
    if (!isset($password)) ['status' => -1, 'message' => 'Please enter your email'];

    // Check if the email is well formatted
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) ['status' => -1, 'message' => 'Your email is invalid'];
    if (strlen($password) < 8)
        return ['status' => -1, 'message' => 'Please enter a password >=8 characters'];

    // Check if the email has not been banned
    $result = DBHelper::query('SELECT * FROM users WHERE email = ?', [$_POST['email']]);
    if ($result->rowCount() == 0)
        return ['status' => -1, 'message' => 'User does not exist!'];

    $user = $result->fetch();
    if ($user['isBanned'] == 1)
        return ['status' => -1, 'message' => 'Your email is banned'];

    if (!password_verify($password, $user['password']))
        return ['status' => -1, 'message' => 'Your password is incorrect.'];

    $_SESSION['user-id'] = $user['user_ID'];

    return ['status' => 1, 'message' => 'Logged in successfully!'];
}

/**
 * Signs a user out.
 * 
 * @return void
 */
function sign_out()
{
    unset($_SESSION['user-id']);
    session_destroy();

    header('Location: ../pages/index.php');
}

/**
 * Checks if a user is logged in.
 * 
 * @return bool user is logged in
 */
function is_logged()
{
    return isset($_SESSION['user-id']);
}

/**
 * Returns whether or not a user is an
 * administrator.
 * 
 * @return bool user is an administrator
 */
function is_admin()
{
    if (is_logged()) {
        $result = DBHelper::query('SELECT isAdmin FROM users WHERE user_ID = ? AND isAdmin = 1', [$_SESSION['user-id']]);
        return $result->rowCount() == 0;
        //return $result->fetchColumn() == 1;
    }
}
