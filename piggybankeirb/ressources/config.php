<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'it103');
define('DB_NAME', 'it103');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

//cette fonction servira lors du debug 
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}




?>
