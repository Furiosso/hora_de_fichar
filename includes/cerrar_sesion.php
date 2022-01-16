<?php
    include "./datos.php";
    $numero = $_COOKIE["usuario"];
    setcookie("usuario", $numero, time()-60*60*24*30, "/");
    header('Location: ../index.php');
    exit();
?>