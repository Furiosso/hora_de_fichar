<?php
if(isset($_COOKIE["usuario"]) and $_COOKIE["usuario"] > 0 and is_numeric($_COOKIE["usuario"])){
    $usuario = $_COOKIE["usuario"];
}else{
    header('Location: ./index.php');
    exit();
}
?>