<?php
// Initialize app
require_once("core/init.php");

// Current selected page
$PAGE = isset($_GET['page']) ? $_GET['page'] : 'home';

// Check users permissions
// Check their login
if (!isset($_COOKIE['UserId']))
{
  if ($PAGE == "login")
  {
    $i = -1;
    if (isset($_POST['username']))
    {
      $i = 0;
      $sql = "SELECT Id FROM users WHERE username='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "' LIMIT 1;";
      $ret = $db->query($sql);
      while ($row = $ret->fetchArray()) {
          $i ++;
          setcookie('UserId', $row['Id']);
          $_COOKIE['UserId'] = $row['Id'];
      }
    }
  }
  else if ($PAGE == "users")
  {
    my_error(403);
  }
}
if ($PAGE == "add")
{
  if (isset($_POST['Add']))
  {
    $sql = "INSERT INTO permissions (AppId, UserId, Token) VALUES (" . $_POST['AppId'] . "," . $_POST['UserId'] . ", '" . $_POST['Token'] . "')";
    $ret = $db->query($sql);
    // header('Location: gateway.php?app=' . $_POST['AppId'] . '&user=' . $_POST['UserId'] . '&token=' . $_POST['Token']);
    header('Location: ' . $row['CallbackUrl']);
    exit;
  }
}

// enable CORS
header("Access-Control-Allow-Origin: *");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>G-ID</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="core/bootstrap.css">
  <link rel="stylesheet" href="core/layout.css">
  <link rel="stylesheet" href="core/<?php
// CSS for this page
echo $PAGE . '.css' ?>">
  <script src="core/jquery.js"></script>
  <script src="core/bootstrap.js"></script>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h3>G-ID</h4>
      <ul class="nav nav-pills nav-stacked">
        <h6>User zone</h6>
        <li class="active"><a href="?page=home">Intro</a></li>
        <li><a href="?page=register">Register</a></li>
        <li><a href="?page=permissions&user=<?php echo $_COOKIE['UserId'] ?>">Permissions</a></li>
        <li><a href="?page=login">Login</a></li>
        <li><a href="logout.php">Logout</a></li>
        <hr />
        <h6>Admin zone</h6>
        <li><a href="?page=users">Users</a></li>
        <li><a href="?page=apps">Apps</a></li>
      </ul>
      <br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Docs..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>

    <div class="col-sm-9 px-md-5">
      <div style="margin:20px">
        <?php
        // Page content
        include($PAGE . '.php') ?>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid">
  <p>GordafarID, Centeral Authentication Solution</p>
</footer>

<script src="core/<?php
// Javascript for this page
echo $PAGE . '.js' ?>"></script>
</body>
</html>
<?php
$db->close();
?>