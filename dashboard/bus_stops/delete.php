<?php
$Title = 'Dashboard | Users'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 

if(!isset($_GET['id'])){
    redirect('/dashboard/bus_stops/');
}
if(empty($_GET['id'])){
    redirect('/dashboard/bus_stops/');
}
if(!is_numeric($_GET['id'])){
    redirect('/dashboard/bus_stops/');
}

$id = $_GET['id'];

$stmt = $db->prepare("DELETE FROM bus_stops WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();
redirect("/dashboard/bus_stops");

?>

