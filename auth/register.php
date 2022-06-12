<?php 
$Title = 'Login'; 
require("../partials/header.php");
require("../config/all_config.php"); 
require("../lib/validations.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf_or_error($_POST['csrf_token']);
    $stmt = $mysqli->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST['email']);
    //$stmt->execute();
    //$user = $stmt->get_result()->fetch_assoc();
}
?>


<form name="loginform" method="POST">
    <h1> Register </h1>
    <label>Email: </label>
    <input name="email" type="email" required />
    <label>Password: </label>
    <input name="password" type="password" required/>
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
    <input type="submit" value="Register" />
</form>
