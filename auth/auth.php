<?php

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
    // check if the fields are empty
    if (!isset($email)) ['status' => -1, 'message' => 'Please enter your email'];
    if (!isset($password)) ['status' => -1, 'message' => 'Please enter your email'];

    // check if the email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return ['status' => -1, 'message' => 'Your email is invalid'];

    // check if password length is between 8 characters
    if (strlen($password) < 8) return ['status' => -1, 'message' => 'Please enter a password >=8 characters'];

    // check if the password contains at least 2 special characters
    if (!preg_match_all('/[£$%^&*#@]/', $password) >= 2) return ['status' => -1, 'message' => 'Your password should contain at least 2 special characters.'];

    // check if the file containing banned users exists
    if (file_exists('../data/banned.csv.php')) {
        // check if the email has not been banned
        if (csv_element_in_file('../data/banned.csv.php', "{$email}")) {
            return ['status' => -1, 'message' => 'Your email is banned'];
        }
    } else {
        return ['status' => -1, 'message' => "Banned user's file doesn't exist."];
    }

    // check if the file containing users exists
    if (file_exists('../data/users.csv.php')) {
        // check if the email is in the database already
        if ((csv_element_in_file('../data/users.csv.php', $email)) != null) {
            return ['status' => -1, 'message' => 'User already exists.'];
        }
    } else {
        return ['status' => -1, 'message' => "Users file doesn't exist!"];
    }

    // save user in database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    csv_add_element('../data/users.csv.php', "{$email};$hashedPassword");

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

    // check if the email is well formatted
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) ['status' => -1, 'message' => 'Your email is invalid'];
    if (strlen($password) < 8) return ['status' => -1, 'message' => 'Please enter a password >=8 characters'];

    // check if the file containing banned users exists
    if (file_exists('../data/banned.csv.php')) {
        // check if the email has not been banned
        if (csv_element_in_file('../data/banned.csv.php', "{$email}")) {
            return ['status' => -1, 'message' => 'Your email is banned'];
        }
    } else {
        return ['status' => -1, 'message' => "Banned user's file doesn't exist."];
    }

    // check if the file containing users exists
    if (!file_exists('../data/users.csv.php')) return ['status' => -1, 'message' => "Users file doesn't exist!"];

    if (($user = csv_element_in_file('../data/users.csv.php', "$email;")) == null) return ['status' => -1, 'message' => 'User does not exist!'];

    $user['data'] = explode(';', $user['data']);
    if (!password_verify($password, trim($user['data'][1]))) return ['status' => -1, 'message' => 'Your password is incorrect.'];

    $_SESSION['user-id'] = $user['index'];

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

    // redirect the user to the public page.
    header('Location: ../quotes/index.php');
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
        // check the database
        $result = DBHelper::query('SELECT isAdmin FROM user WHERE user_ID = ? AND isAdmin = 1', [$_SESSION['user-id']]);

        if ($result->rowCount() == 0) return false;

        return $result->fetchColumn() == 1;
    }

    return false;
}
