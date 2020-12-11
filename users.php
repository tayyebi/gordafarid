<?php

// TODO:

// Handle post

// If $_POST['Delete'] != null
// means delete

// If $_POST['Id'] == null
// means register

// If $_POST['Id'] != null
// means update
// if pass was empty don't update

?>

<table class="table">
<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">Username</th>
    <th scope="col">Fullname</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM users";
$ret = $db->query($sql);
while ($row = $ret->fetchArray()) {
    echo "<tr>";
    echo "<td><a class=\"btn btn-primary btn-sm\" href=\"?page=users&id=" . $row['Id'] . "\">Edit: " . $row['Id'] . "</a></td>";
    echo "<td>" . $row['Username'] . "</td>";
    echo "<td>" . $row['Fullname'] . "</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
<?php
$Id = '';
$Username = '';
$Fullname = '';
if (isset($_GET['id']))
{
    $Id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE Id='" . $Id . "' LIMIT 1";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray()) {
        $Username = $row['Username'];
        $Fullname = $row['Fullname'];
        continue;
    }
}
?>
<form method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control" value="<?php echo $Username ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Fullname</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" value="<?php echo $Fullname ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="Keep blank if you want to keep the former value">
    </div>
  </div>
  <input type="hidden" name="Id" value="<?php echo $Id ?>" />

  <input class="btn btn-primary" type="submit" value="Submit" />
  <?php
  if (isset($_GET['id']))
  {
    echo '<input name="Delete" class="btn btn-danger" type="submit" value="Delete" />';
  }
  ?>
</form>
