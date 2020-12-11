<?php
require_once("core/init.php");

// TODO:

// We welcome apps here!

// Logic


// App: AppId, Custom Token Made for User

if (! isset($_GET['app']))
{
    my_error(903);
}

if (! isset($_GET['token']))
{
    my_error(904);
}

// wasn't a server2server request (It was in browser mode)
if (!isset($_GET['s2s']))
{
    // If user didn't give permission to app
    // or
    // If user wasn't login

    if (!isset($_COOKIE['UserId']))
    {
        my_error(403);
    }

    $sql = 'SELECT * FROM permissions as p
    JOIN applications as a on p.AppId = a.Id
    WHERE
    a.Id=' . $_GET['app'] . '
    AND p.UserId=' . $_COOKIE['UserId'];
    $ret = $db->query($sql);
    $permitted = false;
    while ($row = $ret->fetchArray()) {
        $permitted = true;
        continue;
    }

    if (! $permitted)
    {
        header('Location: index.php?page=add&app=' . $_GET['app'] . '&user=' . $_COOKIE['UserId'] . '&token=' . $_GET['token']);
        exit;
    }
}

// else if it was server 2 server request :

// Send Token, AppId, and PrivateKey in second request
// Note: Only Server2Server Request
// This will return the UserId

if (! isset($_GET['private']))
{
    my_error(905);
}

$sql = 'SELECT * FROM permissions as p
JOIN applications as a ON p.AppId = a.Id
WHERE p.Token = \'' . $_GET['token'] . '\'
AND a.Id = \'' . $_GET['app'] . '\'
AND a.PrivateKey = \'' . $_GET['private'] . '\'
';
$ret = $db->query($sql);
$row = $ret->fetchArray();
echo json_encode($row); // user id , app id , etc ...