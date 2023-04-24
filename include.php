<?php

function phpAlert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$database_name = "random_meuk";

$database_connection = new PDO("mysql:host=$servername;dbname=$database_name", $dbUsername, $dbPassword);

echo '<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>';


?>