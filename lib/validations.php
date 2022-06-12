<?php
require('random_functions.php');

function check_csrf_or_error($csrf_token) {
    if(!isset($_SESSION['csrf_token'])){
        redirect('/errors/400.php');
    }
    if(!$csrf_token){
        redirect('/errors/400.php');
    }
    if(!($csrf_token === $_SESSION['csrf_token'])){
        redirect('/errors/400.php');
    }
    return;
}



?>
