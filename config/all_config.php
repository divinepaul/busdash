<?php
session_start();
session_set_cookie_params(36000); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('csrf.php');
require('database.php');
?>
