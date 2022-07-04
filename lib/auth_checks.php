<?php
function is_authenticated(){
    if(isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function check_auth_redirect_if_not(){
    if(!is_authenticated()){
        redirect('/auth/login.php');
    }
}

function check_auth_json(){
    if(!is_authenticated()){
        header('Content-type: application/json');
        echo json_encode("Not Authenticated");
        die();
    }
}

function check_role_or_redirect(string $url,int ...$roles){
    if(!in_array($_SESSION['user']['role'],$roles)){
        redirect($url);
    } 
}

function check_role(int ...$roles){
    return in_array($_SESSION['user']['role'],$roles);
}

?>
