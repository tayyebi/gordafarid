<?php
require_once("core/init.php");
unset($_COOKIE['UserId']); 
setcookie('UserId', "", time()-3600);
my_error(902);