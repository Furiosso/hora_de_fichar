<?php
include "./datos.php";
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$dni = $_POST["dni"];
$ss = $_POST["ss"];
$pass = $_POST["pass"];
$usuario = $_COOKIE["usuario"];
$query="UPDATE empleados SET nombre = '".$nombre."', apellidos = '".$apellidos."', dni = '".$dni."', numero_ss = '".$ss."', pass = '".$pass."' WHERE id = $usuario;";
$mysqli->query($query);
$query="SELECT nombre, apellidos, dni, numero_ss, pass FROM empleados WHERE id = $usuario;";
$tabla = $mysqli->query($query);
$perfil2 = "";
while($fila = $tabla->fetch_array()){
$perfil2 .= "<div><label>Nombre:</label>
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
echo $perfil2;
die();
?>