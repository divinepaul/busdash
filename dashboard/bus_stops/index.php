<?php
$Title = 'Dashboard | Bus Stops'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 

$stmt = $db->prepare("SELECT * FROM bus_stops");
$stmt->execute();
$bus_stops = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<div style="display:flex;justify-content:space-between">
    <h1> Bus Stops </h1>
    <div>
    <a class="link-button" href="/dashboard/bus_stops/add.php"><i class="fa-solid fa-plus"></i>Add Bus Stops</a>
    <a class="link-button" href="/dashboard/bus_stops/map.php"><i class="fa-solid fa-map"></i>View on Map</a>
    </div>
</div>
<table>
<tr>
    <th>id</th>
    <th>name</th>
    <th>lattitue</th>
    <th>longitude</th>
    <th>Address</th>
    <th>Actions</th>
</tr>

<?php
foreach ($bus_stops as $stop) {
    echo "<tr>";
    echo "<td>{$stop['id']}</td>";
    echo "<td>{$stop['name']}</td>";
    echo "<td>{$stop['loc_lat']}</td>";
    echo "<td>{$stop['loc_long']}</td>";
    echo "<td>{$stop['address']}</td>";
    echo "<td class=\"action-td\">
            <a class=\"icon-button\" href=\"/dashboard/bus_stops/edit.php?id={$stop['id']}\"><i class=\"fa-solid fa-pen\"></i></a>
            <a class=\"icon-button\" style=\"background: red\" href=\"/dashboard/bus_stops/delete.php?id={$stop['id']}\"><i class=\"fa-solid fa-trash\"></i></a>
         </td>";
    echo "</tr>";
}
?>

</table>

