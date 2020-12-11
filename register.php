<?php
if (isset($_POST['username'])){
    $sql = "INSERT INTO users (Username, Password) VALUES ("
    . "'" . $_POST['username'] . "', "
    . "'" . $_POST['password'] . "'"
    . ");";

    $ret = $db->exec($sql);
    if(!$ret) {
        echo $db->lastErrorMsg();
    } else {
        echo <<< EOF
        <div class="alert alert-info" role="alert">
        Registered!
        </div>
EOF;
    }
}
?>
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="username" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password">
    <small id="emailHelp" class="form-text text-muted">Double check capslock and language</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>