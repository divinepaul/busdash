<?php
$Title = 'Dashboard | Bus Stops'; 
include("../config/all_config.php"); 
include("../lib/all_lib.php"); 
check_auth_json();

$stmt = $db->prepare("SELECT * FROM bus_stops");
$stmt->execute();
$bus_stops = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);


$stmt->close();


header('Content-type: application/json');
echo json_encode($bus_stops);

?>
