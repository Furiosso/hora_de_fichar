<?php
    require "./datos.php";
    $mes = $_POST["mes"];
    $ano = $_POST["ano"];
    $usuario = $_COOKIE["usuario"];
    $query = "SELECT registros.id, tipos.icono, tipos.tipo, dia, hora, longitud, latitud, observaciones FROM registros JOIN tipos ON registros.tipo = tipos.id WHERE YEAR(dia) = ".$ano." AND MONTH(dia) = ".$mes." AND usuario = ".$usuario." ORDER BY dia, hora;";
    $tabla = $mysqli->query($query);
    $html = "<div  class=\"wrapper style2 special\"><h3 style=\"text-align: center\"><i class=\"fas fa-calendar-alt\"></i> Datos del ".$mes."º mes de ".$ano." | <a href=\"includes/ver_mes_xls.php?ano=".$ano."&mes=".$mes."\"><i class=\"far fa-file-excel\"></i> Descargar</a></h3><table><tbody>";
    $hoy = NULL;
    $hora2 = NULL;
    $hora1 = NULL;

    while($fila = $tabla->fetch_array()){
        if($hoy != NULL && $hoy != $fila["dia"]){
            if($hora1 != NULL && $hora2 != NULL){               
                $hora_uno = strtotime($hora1);
                $hora_dos = strtotime($hora2);
            }
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
            $html .= "<tr style=\"background-color: #4696e5; color: #ffffff; font-weight: bold; border-width: 7px; border-color: white; border-top: 0\"><td></td><td>HORAS TRABAJADAS</td><td>".$horas.":".$minutos.":".$segundos."</td></td><td></td><td></td></tr>";
        }
        if($hoy != $fila["dia"]){
            $html .= "<tr style=\"background-color: #4696e5; color: #ffffff; font-weight: bold\"><td></td><td style=\"text-align: left\">DÍA  ".$fila["dia"]."</td><td></td><td></td><td></tr>";
            $hoy = $fila["dia"];
            $hora1 = $fila["hora"];
        }
        if($fila["observaciones"] == NULL){
            $html .= "<tr><td>".$fila["icono"]."</td><td>".$fila["tipo"]."</td><td>".$fila["hora"]."</td><td onclick=\"observaciones(".$fila["id"].")\"><i class=\"fas fa-comment-medical\"></i></td><td onclick=\"ver_mapa(".$fila["longitud"].", ".$fila["latitud"].")\"><i class=\"fas fa-map-marked-alt\"></i></td></tr>";    
       }else{
           $html .= "<tr><td>".$fila["icono"]."</td><td>".$fila["tipo"]."</td><td>".$fila["hora"]."</td><td onclick=\"observaciones_texto(".$fila["id"].")\"><i class=\"fas fa-comment-dots\"></i></i></td><td onclick=\"ver_mapa(".$fila["longitud"].", ".$fila["latitud"].")\"><i class=\"fas fa-map-marked-alt\"></i></td></tr>";   
       }    
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
    $html .= "<tr style=\"background-color: #4696e5; color: #ffffff; font-weight: bold\"><td></td><td>HORAS TRABAJADAS</td><td>".$horas.":".$minutos.":".$segundos."</td></td><td></td><td></td></tr></tbody></table></div>";
    echo $html;
    die();