<?php
$Title = 'Dashboard | Users'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 
?>

<h1> Add Users </h1>
<br>
<br>

<?php
$name_input = new Input("name");
$name_input->label = "Full Name";
$name_input->minLength = 3;


$email_input = new Input("email");
$email_input->type = "email";
$email_input->label = "Email";
$email_input->minLength = 3;

$pass_input = new Input("password");
$pass_input->type = "password";
$pass_input->label = "Password";
$pass_input->minLength = 3;

$select_input = new Input("role");
$select_input->type = "select";
$select_values = array("1" => "admin","2" => "driver","3" => "user");

$select_input->selectOptions = $select_values;

$form = new Form($_POST,$name_input,$email_input,$pass_input,$select_input);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $form->validate();
}

$form->render();

?>



