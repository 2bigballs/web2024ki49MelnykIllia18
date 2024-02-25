<?php

$hostName = "localhost";
$dbUser = "id21921374_bigballs";
$dbPassword = "Bigballs1234@";
$dbName = "id21921374_bigballsdb";
$connection = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$connection) {
    die("Something went wrong;");
}

?>