<?php
include "./datos.php";
$usuario = $_COOKIE["usuario"];
$query="SELECT nombre, apellidos, dni, numero_ss, pass FROM empleados WHERE id = $usuario;";
$tabla = $mysqli->query($query);
$perfil = "";
while($fila = $tabla->fetch_array()){
$perfil .= "<div><label>Nombre:</label>
    <input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["nombre"]."\" id=\"nombre\" value=\"".$fila["nombre"]."\">
    <label>Apellidos:</label>
    <input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["apellidos"]."\" id=\"apellidos\" value=\"".$fila["apellidos"]."\">
    <label>D.N.I.:</label>
    <input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["dni"]."\" id=\"dni\" value=\"".$fila["dni"]."\">
    <label>Número de la Seguridad Social:</label>
    <input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["numero_ss"]."\" id=\"ss\" value=\"".$fila["numero_ss"]."\">
    <label>Contraseña:</label>
    <input style=\"margin-bottom: 6px;\" type=\"text\" placeholder=\"".$fila["pass"]."\" id=\"pass\" value=\"".$fila["pass"]."\"></div>";
}
echo $perfil;
die();