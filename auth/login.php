<?php 
$Title = 'Login'; 
include("../config/all_config.php"); 
include("../lib/all_lib.php");
include("../partials/header.php"); 

$errors = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    check_csrf_or_error($_POST['csrf_token']);
    $errors = check_if_input_emtpy("email","password");

    if(!$errors){
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $_POST['email']);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if(!$user){
            $errors['Email'] = "No such account exists!";
        } else 
        if(!password_verify($_POST['password'],$user['password'])){
            $errors['Password'] = "Wrong password!";
        } else 
        if(!$errors){
            $_SESSION['user'] = $user;
            redirect('/dashboard/');
        } 
    }
}

?>


<form name="loginform" method="POST">
    <h1> Login </h1>
    <label>Email: </label>
    <input name="email" type="email" required />
    <label>Password: </label>
    <input name="password" type="password" />
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />
    <div class="errors-list">
    <?php
        foreach ($errors as $key => $value) {
            echo "<p>{$key} : {$value}</p>";
            echo "</br>";
        }
    ?> 
    </div>
    <input type="submit" value="Login" />
</form>
