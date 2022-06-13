<?php
$Title = 'Dashboard | Busdash'; 
include("../config/all_config.php"); 
include("../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../partials/dashboard_header.php"); 

$stmt = $db->prepare("SELECT * FROM users INNER JOIN roles ON users.role=roles.id");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>



<h1> Users </h1>
<table>
<tr>
    <th>id</th>
    <th>name</th>
    <th>email</th>
    <th>role</th>

</tr>

<?php
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>{$user['id']}</td>";
    echo "<td>{$user['name']}</td>";
    echo "<td>{$user['email']}</td>";
    echo "<td>{$user['role']}</td>";
    echo "</tr>";
}
?>

</table>
