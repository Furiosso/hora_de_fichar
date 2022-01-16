<?php
$hostname = "localhost";
$database = "daniel";
$username = "daniel";
$password = "daniel123456";

$mysqli = new mysqli($hostname, $username, $password, $database);
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
} else {
    $mysqli->set_charset("utf8");
}