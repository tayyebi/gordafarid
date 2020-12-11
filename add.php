<?php
$sql = "SELECT * FROM applications WHERE Id=" . $_GET['app'];
$ret = $db->query($sql);
$row = $ret->fetchArray();
?>
<div class="jumbotron">
  <h1 class="display-4">Allow app</h1>
  <p class="lead">Is this app allowed to use your data?</p>
  <hr class="my-4">
  <p>
  <?php
    echo '
    <ul class="list-group">
        <li class="list-group-item">' . $row['Id'] .  '<span class="badge badge-primary badge-pill">Id</span></li>
        <li class="list-group-item">' . $row['CallbackUrl'] .  '<span class="badge badge-primary badge-pill">Url</span></li>
        <li class="list-group-item">' . $row['Name'] .  '<span class="badge badge-primary badge-pill">Name</span></li>
    </ul>
    ';
  ?>
  </p>
  <form class="lead" method="post">
    <input name="AppId" type="hidden" value="<?php echo $_GET['app'] ?>" />
    <input name="Token" type="hidden" value="<?php echo $_GET['token'] ?>" />
    <input name="UserId" type="hidden" value="<?php echo $_GET['user'] ?>" />
    <input name="Add" type="submit" class="btn btn-secondary btn-lg" value="Yes; Sure!" />
    <a href="index.php" class="btn btn-primary btn-lg">No! Bring me back home!</a>
    <a href="<?php echo $row['CallbackUrl'] ?>" class="btn btn-primary btn-lg">No! Bring me back to website</a>
  </form>
</div>