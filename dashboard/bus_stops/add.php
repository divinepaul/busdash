<?php
$Title = 'Dashboard | Add Bus Stops'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 


?>
<h1> Add Bus Stop </h1>
<br>
<br>

<?php
$name_input = new Input("name");
$name_input->type = "text";
$name_input->mysqli_type = "s";
$name_input->label = "Name of Bus Stop";
$name_input->minLength = 3;


$lot_input = new Input("loc_lat");
$lot_input->type = "text";
$lot_input->label = "Lattitude";
$lot_input->mysqli_type = "d";
$lot_input->minLength = 4;

$long_input = new Input("loc_long");
$long_input->type = "text";
$long_input->label = "Longitude";
$long_input->mysqli_type = "d";
$long_input->minLength = 4;

$address_input = new Input("address");
$address_input->type = "text";
$address_input->mysqli_type = "s";
$address_input->label = "Address";
$address_input->minLength = 8;

$form = new Form($name_input,$lot_input,$long_input,$address_input);
$form->sql_table = "bus_stops";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($form->validate()) {
        $form->save();
        redirect("/dashboard/bus_stops/");
    } 

}

$form->render();

?>
