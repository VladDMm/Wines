<?php

//main connection file for both admin & front end
// $servername = "localhost"; //server
// $username = "root"; //username
// $password = "root"; //password
// $dbname = "wine_db";  //database

$servername = "sql.freedb.tech"; //server
$username = "freedb_administrator_root"; //username

$dbname = "freedb_wine_db";  //database

// Create connection
$db = mysqli_connect($servername, $username, 'pe#NCrM5R$ZuJRk', $dbname); // connecting 
// Check connection
if (!$db) {       //checking connection to DB	
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($db, "utf8mb4");

?>