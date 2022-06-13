<?php
// store the token in the session
if (!isset($_SESSION['csrf_token'])) {
    // TODO: unsafe ?? 
    $csrf_token= md5(uniqid(rand(), TRUE));
    $_SESSION['csrf_token'] = $csrf_token;
} else {
    $csrf_token = $_SESSION['csrf_token'];
}

?>
