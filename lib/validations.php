<?php

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

function check_if_input_emtpy(...$feild_names) {
    $errors = array();
    foreach($feild_names as $feild_name){
        if(!isset($_POST[$feild_name]) || $_POST[$feild_name] == ""){
            $errors[$feild_name] = "No value given.";
        }
    }
    return $errors;
}
?>
