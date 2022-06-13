<?php
$Title = 'Dashboard | Busdash'; 
include("../config/all_config.php"); 
include("../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../partials/dashboard_header.php"); 


$stmt = $db->prepare("SELECT * FROM roles");
$stmt->execute();
$roles = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>



<h1> Roles </h1>
<table>
<tr>
    <th>id</th>
    <th>role</th>

</tr>

<?php
foreach ($roles as $role) {
    echo "<tr>";
    echo "<td>{$role['id']}</td>";
    echo "<td>{$role['role']}</td>";
    echo "</tr>";
}
?>

</table>
