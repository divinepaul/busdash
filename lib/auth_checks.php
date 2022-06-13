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
?>
