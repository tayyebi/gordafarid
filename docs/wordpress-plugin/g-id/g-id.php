<?php
/**
* Plugin Name: G-ID
* Plugin URI: http://g-id.ir
* Description: G-ID authentication plugin
* Version: 1.0
* Author: Mohammad R. Tayyebi
* Author URI: http://tyyi.net/
**/


// Variables from www.g-id.ir
$GID_Server = "http://localhost/g-id.ir/";
$GID_Identifier = "8";
$GID_Name = "wordpress";
$GID_PrivateKey = "pFaHHFbIyvWTbQ2bdxvU";

// Logic


// Generate a privat token between
// g-id server and wordpress website
$Token = time(); // must be a random secret
if (isset($_COOKIE['token']))
{
    // use previously generated token
    $Token = $_COOKIE['token'];
}
else
{
    setcookie("token", $Token, time() + (86400 * 30), "/");
}

// Build server 2 server URI
$URL_TO_REQUEST = $GID_Server . "gateway.php?s2s" . "&app=" . $GID_Identifier . "&token=" . $Token . "&private=" . $GID_PrivateKey;

// Send HTTP GET request to g-id server
$response = file_get_contents($URL_TO_REQUEST);

// `false` means token is not vali
if ($response == "false")
{
    $URL_TO_PERMISSION = $GID_Server . "gateway.php?" . "app=" . $GID_Identifier . "&token=" . $Token ;
    echo '
    <script type="text/javascript">
    alert("You aren\'t authorized! Redirecting...");
    window.location = "' . $URL_TO_PERMISSION . '";
    </script>
    ';
    
    //header("Location: " . $URL_TO_PERMISSION);
     exit;
}
else
{
    $response_decoded = json_decode($response);
    echo "Logged in: user #" . $response_decoded->UserId;
}

