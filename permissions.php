<?php
include_once('random_int.php');

if (isset($_POST['Delete']))
{
    $sql = 'DELETE FROM permissions
    WHERE Id=' . $_POST['Id'];
    $ret = $db->query($sql);
    echo '<div class="alert alert-success" role="alert">
        Successfult revoked permission #' . $_POST['Id'] . '!
    </div>';
}

?>

<table class="table">
<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">AppId</th>
    <th scope="col">App Name</th>
    <th scope="col">App Url</th>
</tr>
</thead>
<tbody>
<?php
$sql = 'SELECT p.Id as Id, CallbackUrl, Name, AppId, UserId FROM permissions as p
JOIN applications as a on p.AppId = a.Id
WHERE p.UserId=' . $_GET['user'];
$ret = $db->query($sql);
while ($row = $ret->fetchArray()) {
    echo "<tr>";
    echo "<td><a class=\"btn btn-primary btn-sm\" href=\"?page=permissions&user=" . $row['UserId'] . "&id=" . $row['Id'] . "\">Revoke: " . $row['Id'] . "</a></td>";
    echo "<td>" . $row['AppId'] . "</td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['CallbackUrl'] . "</td>";
    echo "</tr>";
}
?>
</tbody>
</table>

<?php
$Id = '';
if (isset($_GET['id']))
{
    $Id = $_GET['id'];
    $sql = "SELECT * FROM permissions WHERE Id='" . $Id . "' LIMIT 1";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray()) {
        $Id = $row['Id'];
        continue;
    }
}

if (isset($_GET['id']) && !isset($_POST['Delete']))
{
    echo '<form method="post">
    <div class="alert alert-danger" role="alert">
        Are you sure to revoke permission #' . $Id . '?
    </div>
    <input type="hidden" name="Id" value="' . $Id . '" />
    <input name="Delete" class="btn btn-danger" type="submit" value="Yes I\'m Sure" />
</form>';
}
?>

