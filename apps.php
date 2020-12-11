<?php
include_once('random_int.php');

if (isset($_POST['Name']))
{
    if ($_POST['Delete'])
    {
        // TODO:
        // Delete
    }
    else if ($_POST['Id']) {
        // TODO:
        // Update  
    }
    else {
        $sql = "INSERT INTO applications (Name, CallbackUrl, PrivateKey, AdminId) VALUES ("
        . "'" . $_POST['Name'] . "', "
        . "'" . $_POST['CallbackUrl'] . "',"
        . "'" . $_POST['PrivateKey'] . "',"
        . "" . $_POST['AdminId'] . ""
        . ");";

        $ret = $db->exec($sql);
        if(!$ret) {
            echo $db->lastErrorMsg();
        } else {
            echo <<< EOF
            <div class="alert alert-info" role="alert">
            Submited app!
            </div>
EOF;
        }
    }
}

?>
<table class="table">
<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">Name</th>
    <th scope="col">CallbackUrl</th>
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM applications";
$ret = $db->query($sql);
while ($row = $ret->fetchArray()) {
    echo "<tr>";
    echo "<td><a class=\"btn btn-primary btn-sm\" href=\"?page=apps&id=" . $row['Id'] . "\">Edit: " . $row['Id'] . "</a></td>";
    echo "<td>" . $row['Name'] . "</td>";
    echo "<td>" . $row['CallbackUrl'] . "</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
<?php

$Id = '';
$Name = '';
$CallbackUrl = '';
$AdminId = '';
$PrivateKey = '';

if (isset($_GET['id']))
{
    $Id = $_GET['id'];
    $sql = "SELECT * FROM applications WHERE Id='" . $Id . "' LIMIT 1";
    $ret = $db->query($sql);
    while ($row = $ret->fetchArray()) {

        $Name = $row['Name'];
        $CallbackUrl = $row['CallbackUrl'];
        $AdminId = $row['AdminId'];
        $PrivateKey = $row['PrivateKey'];
        continue;
    }
}


if ($PrivateKey == '')
{
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

   for ($i=0; $i < 20; $i++) {
       $PrivateKey .= $codeAlphabet[random_int(0, $max-1)];
   }
}
?>
<form method="post">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input name="Name" type="text" class="form-control" value="<?php echo $Name ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Callback URL</label>
    <div class="col-sm-10">
      <input name="CallbackUrl" type="text" class="form-control" value="<?php echo $CallbackUrl ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Private Key</label>
    <div class="col-sm-10">
      <input name="PrivateKey" type="text" class="form-control" value="<?php echo $PrivateKey ?>">
    </div>
  </div>
  
  <input type="hidden" name="AdminId" value="<?php echo $_COOKIE['UserId'] ?>" />
  <input type="hidden" name="Id" value="<?php echo $Id ?>" />

  <input class="btn btn-primary" type="submit" value="Submit" />
  <?php
  if (isset($_GET['id']))
  {
    echo '<input name="Delete" class="btn btn-danger" type="submit" value="Delete" />';
  }
  ?>
</form>
