<?php
require "./datos.php";
$id = $_POST["id"];
$query = "SELECT id, observaciones FROM registros WHERE id = ".$id.";";
$tabla = $mysqli->query($query);
$fila = $tabla->fetch_array();
$html = "<input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["observaciones"]."\" id=\"observacion\" value=\"".$fila["observaciones"]."\">
<input class=\"invisible\" id=\"id_observaciones\" value=\"".$fila["id"]."\">";
echo $html;
die();
?>