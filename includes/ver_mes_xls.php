<?php
    include "./datos.php";
    $ano = $_GET["ano"];
    $mes = $_GET["mes"];
    $usuario = $_COOKIE["usuario"];
    $query = "SELECT nombre, apellidos, dni, numero_ss FROM empleados WHERE id = ".$usuario.";";
    $datos_empleado = $mysqli->query($query);
    $fila = $datos_empleado->fetch_array();
    $nombre = $fila["nombre"];
    $apellidos = $fila["apellidos"];
    $dni = $fila["dni"];
    $numero_ss = $fila["numero_ss"];
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=HORADEFICHAR Registro de ".$nombre." ".$apellidos." del ".$mes."º mes de ".$ano.".xls");      
    $query2 = "SELECT registros.id, tipos.icono, tipos.tipo, dia, hora, longitud, latitud, observaciones FROM registros JOIN tipos ON registros.tipo = tipos.id WHERE YEAR(dia) = ".$ano." AND MONTH(dia) = ".$mes." AND usuario = ".$usuario." ORDER BY dia, hora;";
    $tabla = $mysqli->query($query2);
?>
<head><meta charset="UTF-8"></head>
<table><tbody><tr><td>NOMBRE: <?= $nombre?></td><td>APELLIDOS: <?= $apellidos?></td><td>D.N.I.: <?= $dni?></td><td>NÚMERO DE LA SEGURIDAD SOCIAL: <?= $numero_ss?></td></tr>
<tr><td></td><td></td><td>Datos del <?= $mes?>º mes de <?= $ano?></td><td></td><td></td></tr>
<?php
$hoy = NULL;
$hora2 = NULL;
$hora1 = NULL;
while($fila = $tabla->fetch_array()){
    if($hoy != NULL && $hoy != $fila["dia"]){
        $hora_uno = strtotime($hora1);
        $hora_dos = strtotime($hora2);
        $resultado = $hora_dos - $hora_uno;
        $minutos = $resultado/60;
        $segundos = $resultado%60;
        $horas = bcdiv(($minutos/60), 1, 0);
        $minutos %= 60;
        if($horas < 10)
            $horas = "0".$horas;
        if($minutos < 10)
            $minutos = "0".$minutos;
        if($segundos < 10)
            $segundos = "0".$segundos;
        ?>
        <tr style= "background-color: #4696e5; color: #ffffff; font-weight: bold; border-width: 7px; border-color: white; border-top: 0"><td></td><td>HORAS TRABAJADAS</td><td><?=$horas?>:<?=$minutos?>:<?=$segundos?></td></td><td></td><td></td></tr>
    <?php
    }
    if($hoy != $fila["dia"]){
        ?>
        <tr style="background-color: #4696e5; color: #ffffff; font-weight: bold"><td></td><td style="text-align: left">DÍA  <?=$fila["dia"]?></td><td></td><td></td><td></tr>
    <?php
        $hoy = $fila["dia"];
        $hora1 = $fila["hora"];
    }
    ?>
    <tr><td><?=$fila["icono"]?></td><td><?=$fila["tipo"]?></td><td><?=$fila["hora"]?></td><td><?=$fila["longitud"]?></td><td><?=$fila["latitud"]?></td><td><?=$fila["observaciones"]?></td></tr>
    <?php
    $hora2 = $fila["hora"];
}
$hora_uno = strtotime($hora1);
$hora_dos = strtotime($hora2);
$resultado = $hora_dos - $hora_uno;
$minutos = $resultado/60;
$segundos = $resultado%60;
$horas = bcdiv(($minutos/60), 1, 0);
$minutos %= 60;
if($horas < 10)
    $horas = "0".$horas;
if($minutos < 10)
    $minutos = "0".$minutos;
if($segundos < 10)
    $segundos = "0".$segundos;
?>
<tr style="background-color: #4696e5; color: #ffffff; font-weight: bold"><td></td><td>HORAS TRABAJADAS</td><td><?=$horas?>:<?=$minutos?>:<?=$segundos?></td></td><td></td><td></td></tr></tbody></table>



