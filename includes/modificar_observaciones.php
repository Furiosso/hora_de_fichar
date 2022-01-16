<?php
require "./datos.php";
$observaciones = $_POST["observacion"];
$id = $_POST["id_observaciones"];
$query = "UPDATE registros SET observaciones = '".$observaciones."' WHERE id = $id;";
$mysqli->query($query);
$query = "SELECT observaciones FROM registros WHERE id = ".$id.";";
$tabla = $mysqli->query($query);
$fila = $tabla->fetch_array();
$observacion = "<input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["observaciones"]."\" id=\"observacion\" value=\"".$fila["observaciones"]."\">";
echo $observacion;
die();
?>