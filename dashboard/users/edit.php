<?php
$Title = 'Dashboard | Users'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 

if(!isset($_GET['id'])){
    redirect('/dashboard/users/');
}
if(empty($_GET['id'])){
    redirect('/dashboard/users/');
}
if(!is_numeric($_GET['id'])){
    redirect('/dashboard/users/');
}

$id = $_GET['id'];

?>
<h1> Edit </h1>
<br>
<br>

<?php

$name_input = new Input("name");
$name_input->type = "text";
$name_input->mysqli_type = "s";
$name_input->label = "Full Name";
$name_input->minLength = 3;


$email_input = new Input("email");
$email_input->type = "email";
$email_input->label = "Email";
$email_input->mysqli_type = "s";
$email_input->minLength = 3;

$pass_input = new Input("password");
$pass_input->type = "password";
$pass_input->label = "Password";
$email_input->mysqli_type = "s";
$pass_input->minLength = 3;

$select_input = new Input("role");
$select_input->type = "select";
$select_input->mysqli_type = "i";
$select_values = array(1 => "admin",2 => "driver",3 => "user");

$select_input->selectOptions = $select_values;

$form = new Form($name_input,$email_input,$pass_input,$select_input);
$form->sql_table = "users";
$form->sql_id = $id;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($form->validate()) {
        $form->save();
        redirect("/dashboard/users/");
    } 

}
$form->render();

?>
