<?php
    if(isset($_COOKIE["usuario"]) and $_COOKIE["usuario"] > 0 and is_numeric($_COOKIE["usuario"])){
        header('Location: ./principal.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>Hora de fichar</title>
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            function perfil(){
                $("#dialog-perfil").dialog({
                    modal: true,
                    width: 325
                });
            }
            $(document).ready(function(){        
                $('#alta').submit( function (e) {
                    e.preventDefault();
                    var nombre = $('#nombre').val();
                    var apellidos = $('#apellidos').val();
                    var dni = $('#dni2').val();
                    var ss = $('#ss').val();
                    var pass = $('#pass2').val();
                    var pass2 = $('#pass3').val();
                    if(pass != pass2){
                        alert("La segunda contraseña que has introducido no coincide con la primera. Vuelve a intentarlo");
                    }else{
                        $.ajax({
                            method: "POST",
                            url: "includes/crear_perfil.php",
                            data: {nombre: nombre, apellidos: apellidos, dni: dni, ss: ss, pass: pass}
                        }).done(); 
                        $('#dialog-perfil').dialog("close"); 
                    }                                       
                });         
            })
        </script>

    </head>
    <body>
        <subheader>
            <h5 class="encabezado"><span>¿NO ESTÁS REGISTRADO?</span><a style="color: white; cursor: pointer;" onclick="perfil();">DATE DE ALTA</a></h5>
        </subheader>

        <header id="header" style="height: 100vh;">           
            <h1 style="text-align: center; margin-top: 7%;">HORA DE FICHAR</h1>
            <form id="form_entrata" method="post" action="includes/entrada.php" style="width: 100%;
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 40px;
            margin-bottom: 100px;">
                <fieldset>
                    <?php
                        if(isset($_GET["error"]) && $_GET["error"] == 1){
                    ?>
                        <legend style="margin-bottom: 10px">
                            <i class="fas fa-exclamation-circle"></i> Error, usuario o contraseña incorrecto
                        </legend>
                    <?php
                        }else{
                    ?>
                        <legend style="margin-bottom: 10px">Acceso:</legend>
                    <?php
                        }
                    ?>
                        <label>
                            D.N.I.:<br>
                            <input type="text" name="dni" id="dni" placeholder="D.N.I.">
                        </label>
                        <label>
                            CONTRASEÑA:<br>
                            <input type="password" name="pass" id="pass" placeholder="Contraseña" >
                        </label>
                        <div style="text-align: center">
                        <input type="submit" value="Entrar" id="entrar" style="margin: auto">
                        </div> 
                </fieldset>
            </form>
        </header>

        <div id="dialog-perfil" title="Crear usuario" class="invisible">
            <form id="alta" method="post" autocomplete="off" style="text-align: center">
            <label>Nombre:</label>
            <input style="margin-bottom: 6px;" pattern="[a-zA-z]+" title="No puedes poner números en el nombre" type="text" placeholder="Nombre" id="nombre" required>
            <label>Apellidos:</label>
            <input style="margin-bottom: 6px;" pattern="[a-zA-z]+" title="No puedes poner números en los apellidos" type="text" placeholder= "Apellidos" id="apellidos" required>
            <label>D.N.I.:</label>
            <input style="margin-bottom: 6px;" pattern="[x-zX-Z0-9]\d{7}[a-zA-Z]" title="El D.N.I. tiene que estar formado por 8 números seguidos de una letra, el N.I.E. tiene que empezar por una letra seguida de 7 números y otra letra" type="text" placeholder="D.N.I." id="dni2" required>
            <label>Número de la Seguridad Social:</label>
            <input style="margin-bottom: 6px;" pattern="\d{12}" title="El número de la Seguridad Social está formado por 12 cifras" type="text" placeholder="Número de la seguridad social" id="ss" required>
            <label>Contraseña:</label>
            <input type="password" required placeholder="Contraseña" id="pass2">
            <label>Repite la contraseña:</label>
            <input type="password" placeholder="Contraseña" id="pass3">
            <button type="submit" style="margin-top: 1em">Guardar</button>
            </form>
        </div>
    
        <script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 		<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
    </body>
</html>