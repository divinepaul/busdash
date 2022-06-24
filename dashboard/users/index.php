<?php
$Title = 'Dashboard | Users'; 
include("../../config/all_config.php"); 
include("../../lib/all_lib.php"); 
check_auth_redirect_if_not();
include("../../partials/dashboard_header.php"); 

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

?>

<br>
<br>
<div style="display:flex;justify-content:space-between">
    <h1> Users </h1>
    <div>
    <a class="link-button" href="/dashboard/users/add.php"><i class="fa-solid fa-pen"></i>Add User</a>
    </div>
</div>
<table>
<tr>
    <th>id</th>
    <th>email</th>
    <th>name</th>
    <th>role</th>
</tr>

<?php
foreach ($users as $user) {
    echo "<tr>";
    echo "<td>{$user['id']}</td>";
    echo "<td>{$user['email']}</td>";
    echo "<td>{$user['name']}</td>";
    echo "<td>{$user['role']}</td>";
    echo "</tr>";
}
?>

</table>

