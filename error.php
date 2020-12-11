<?php

$errors_list = array(
    100 => "Continue, Informational",
    101 => "Switching Protocols, Informational",

    200 => "OK, Successful",
    201 => "Created, Successful",
    202 => "Accepted, Successful",
    203 => "Non-Authoritative Information, Successful",
    204 => "No Content, Successful",
    205 => "Reset Content, Successful",
    206 => "Partial Content, Successful",

    300 => "Multiple Choices, Redirection",
    301 => "Moved Permanently, Redirection",
    302 => "Found, Redirection",
    303 => "See Other, Redirection",
    304 => "Not Modified, Redirection",
    305 => "Use Proxy, Redirection",
    307 => "Temporary Redirect, Redirection",

    400 => "Bad Request, Client Error",
    401 => "Unauthorized, Client Error",
    402 => "Payment Required, Client Error",
    403 => "Forbidden, Client Error",
    404 => "Not Found, Client Error",
    405 => "Method Not Allowed, Client Error",
    406 => "Not Acceptable, Client Error",
    407 => "Proxy Authentication Required, Client Error",
    408 => "Request Timeout, Client Error",
    409 => "Conflict, Client Error",
    410 => "Gone, Client Error",
    411 => "Length Required, Client Error",
    412 => "Precondition Failed, Client Error",
    413 => "Request Entity Too Large, Client Error",
    414 => "Request-URI Too Long, Client Error",
    415 => "Unsupported Media Type, Client Error",
    416 => "Requested Range Not Satisfiable, Client Error",
    417 => "Expectation Failed, Client Error",
    
    500 => "Internal Server Error, Server Error",
    501 => "Not Implemented, Server Error",
    502 => "Bad Gateway, Server Error",
    503 => "Service Unavailable, Server Error",
    504 => "Gateway Timeout, Server Error",
    505 => "HTTP Version Not Supported, Server Error",

    901 => "Cannot connect to database",
    902 => "Logged out",
    903 => "Application identifier info is not present",
    904 => "Custom token is not present",
    905 => "Application private key is not present",
);

$CODE = null;
$TEXT = null;

foreach ($errors_list as $key => $value) {
    if ((isset($_GET['error']) ? $_GET['error'] :  404) == $key) {
        $CODE = $key;
        $TEXT = $value;
        continue;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>ERROR <?php echo $CODE ?></title>

<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="core/error.css" />


<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>
<body>
<div id="notfound">
<div class="notfound">
<div class="notfound-404">
<h1><span><?php echo $CODE ?></span></h1>
</div>
<h2><?php echo $TEXT ?></h2>

<!--
<form class="notfound-search">
<input type="text" placeholder="Search...">
<button type="button"><span></span></button>
</form>
-->
<a href="index.php" class="mylink">Back</a>
</div>
</div>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="1c87af1aeefe3ccba85088ae-text/javascript"></script>
<script type="1c87af1aeefe3ccba85088ae-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="1c87af1aeefe3ccba85088ae-|49" defer=""></script></body>
</html>
