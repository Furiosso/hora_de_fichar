<?php
include "./datos.php";
$id = $_POST["id_observaciones"];
$query = "UPDATE registros SET observaciones = NULL WHERE id = $id";
$mysqli->query($query);
?>