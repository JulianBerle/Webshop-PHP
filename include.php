<?php

function phpAlert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database_name = "random_meuk";

$database_connection = new PDO("mysql:host=$servername;dbname=$database_name", $dbUsername, $dbPassword);


?>