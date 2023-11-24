<?php

$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "bazarsenac";

// $dbHost     = "sql204.infinityfree.com";
// $dbUsername = "if0_35480709";
// $dbPassword = "nwXwRqSS81A";
// $dbName     = "if0_35480709_bazar";

$conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);

$link = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($link->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


?>