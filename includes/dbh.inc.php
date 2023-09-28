<?php

$serverName = "servername";
$dBUsername = "username";
$dBPassword = "password";
$dBName = "dbname";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}