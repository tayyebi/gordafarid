<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <?php
    if ($i == 0) {
      echo <<< EOF
      <div class="alert alert-danger" role="alert">
        Incorrect login!
      </div>
EOF;
    }
    if (isset($_COOKIE['UserId'])) {
      echo <<< EOF
      <div class="alert alert-info" role="alert">
        You are already logged in!
      </div>
      <script>
      window.location="index.php";
      </script>
EOF;
    }
    ?>

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="logo.jpg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="post">
      <input type="text" id="login" class="fadeIn second" name="username" placeholder="login">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="index.php">Bring me back home!</a>
    </div>

  </div>
</div>