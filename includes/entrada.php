<?php
include "./datos.php";
$query = "SELECT id FROM empleados WHERE dni = '" . $_POST["dni"] . "' AND pass = '".$_POST["pass"]."';";
$result = $mysqli->query($query);
if($result->num_rows == 1){
    $fila = $result->fetch_array();
    setcookie("usuario", $fila["id"], time()+60*60*24*30, "/");
    header('Location: ../principal.php');
    exit();
} else {
    header('Location: ../index.php?error=1');
    exit();
};