<?php
    require "./datos.php";
    $usuario = $_COOKIE["usuario"];
    $query = "SELECT registros.id, tipos.icono, tipos.tipo, dia, hora, longitud, latitud, observaciones FROM registros JOIN tipos ON registros.tipo = tipos.id WHERE dia > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -7 DAY) AND usuario = ".$usuario." ORDER BY dia DESC, hora DESC;";
    $tabla = $mysqli->query($query);
    $html = "<div  class=\"wrapper style2 special\"><h3 style=\"text-align: center\"><i class=\"fas fa-calendar-week\"></i> Registros de los últimos siete días</h3><table><tbody>";
    $hoy = NULL;

    while($fila = $tabla->fetch_array()){
        if($hoy != $fila["dia"]){
            $html .= "<tr style=\"background-color: #4696e5; color: #ffffff; font-weight: bold\"><td></td><td style=\"text-align: left\">DÍA  ".$fila["dia"]."</td><td></td><td></td><td></tr>";
            $hoy = $fila["dia"];
        }
        if($fila["observaciones"] == NULL){
            $html .= "<tr><td>".$fila["icono"]."</td><td>".$fila["tipo"]."</td><td>".$fila["hora"]."</td><td onclick=\"observaciones(".$fila["id"].")\"><i class=\"fas fa-comment-medical\"></i></td><td onclick=\"ver_mapa(".$fila["longitud"].", ".$fila["latitud"].")\"><i class=\"fas fa-map-marked-alt\"></i></td></tr>";    
       }else{
           $html .= "<tr><td>".$fila["icono"]."</td><td>".$fila["tipo"]."</td><td>".$fila["hora"]."</td><td onclick=\"observaciones_texto(".$fila["id"].")\"><i class=\"fas fa-comment-dots\"></i></i></td><td onclick=\"ver_mapa(".$fila["longitud"].", ".$fila["latitud"].")\"><i class=\"fas fa-map-marked-alt\"></i></td></tr>";   
       }
    }
    $html .= "</tbody></table></div>";

    
    echo $html;
    die();