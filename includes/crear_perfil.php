<?php
require "./datos.php";
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$ss = $_POST["ss"];
$pass = $_POST["pass"];
$query ="INSERT INTO empleados (nombre, apellidos, dni, numero_ss, pass) VALUES ('$nombre', '$apellidos', '$dni', '$ss', '$pass');";
$mysqli->query($query);
die();
?>