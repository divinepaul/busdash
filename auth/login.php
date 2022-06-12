<?php 
$Title = 'Login'; 
include("../partials/header.php"); 
include("../config/all_config.php"); 
include("../lib/validations.php"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    check_csrf_or_error($_POST['csrf_token']);


    $stmt = $db->prepare("INSERT INTO users (email,password,role) VALUES (?, ?, ?)");
    $role = 1;
    $email = $_POST['email'];
    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
    $stmt->bind_param("ssi", $email, $password, $role);
    $stmt->execute();
    $stmt->close();
}
?>


<form name="loginform" method="POST">
    <h1> Login </h1>
    <label>Email: </label>
    <input name="email" type="email" required />
    <label>Password: </label>
    <input name="password" type="password" required/>
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
    <input type="submit" value="Login" />
</form>
