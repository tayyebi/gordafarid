<?php

function my_error ($code)  {
    header( "Location: error.php?error=" . $code );
    exit;
}

// A class to verify database
class MyDB extends SQLite3 {
    function __construct() {
        $this->open('gid.db');
    }
}

// Try to connect to database
$db = new MyDB();
if(!$db) {
    my_error(901);
}
