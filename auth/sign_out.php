<?php
require_once('../auth/auth.php');
session_start();

// if the user is not logged in, redirect them to the public page
if (!is_logged()) header('Location: ../pages/index.php');

sign_out();
