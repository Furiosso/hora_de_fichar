<?php
	include "./includes/cookies.php";
?>
<!DOCTYPE HTML>
<!--
	Fractal by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>Página de registro</title>
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>                       
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
        <script>
            //Variables GPS
            var latitud = 0.0000;
            var longitud = 0.0000;
            var opciones = {
            //enableHighAccuracy: true,
                timeout: 4000,
                maximumAge: 60000
            };
            //*******
                    

            $(document).ready(function() {
                coordenadas();
            });

            function coordenadas(){
                if (navigator.geolocation) {
                    var wpid = navigator.geolocation.watchPosition(mostrarPosicion, mostrarErrores, opciones);
                    //navigator.geolocation.getCurrentPosition(mostrarPosicion, mostrarErrores, opciones);
                } else {
                    alert("Tu navegador no soporta la geolocalización, actualiza tu navegador.");
                }
            }



            function hoy() {
                $('#html').html('<center><br><br><i class="fas fa-3x fa-sync fa-spin"></i><center>');
                $.ajax({
                    method: "POST",
                    url: "includes/hoy.php"
                }).done(function (html) {
                    $('#html').html(html);
                });
            }


            function guardar(tipo) {
                $('#html').html('<center><br><br><i class="fas fa-3x fa-sync fa-spin"></i><center>');
                $.ajax({
                    method: "POST",
                    url: "includes/guardar.php",
                    data: {tipo: tipo, longitud: longitud, latitud: latitud}
                }).done(function (html) {
                    $('#html').html(html);
                });
            }

            function ver_mes() {
                $('#html').html('<center><br><br><i class="fas fa-3x fa-sync fa-spin"></i><center>');
                var ano = $("#ano").val();
                var mes = $("#mes").val();
                $.ajax({
                    method: "POST",
                    url: "includes/ver_mes.php",
                    data: {ano: ano, mes: mes}
                }).done(function (html) {
                    $('#html').html(html);
                });
            }



            function observaciones(id) {
                $("#dialog-observaciones").dialog({
                    modal: true,
                    buttons: {
                        Guardar: function () {
                            var texto = $("#observaciones").val();
                            $.ajax({
                                method: "POST",
                                url: "includes/guardar_observaciones.php",
                                data: {id: id, observaciones: texto}
                            }).done(function (html) {
                                $('#html').html(html);
                            });
                            $(this).dialog("close");
                        }
                    }
                });
            }


            function observaciones_texto(id) {
                $.ajax({
                    method: "POST",
                    url: "includes/observaciones.php",
                    data: {id: id}
                }).done(function (html) {
                    $('#observaciones-texto').html(html);
                    $("#dialog-observaciones-texto").dialog({
                        modal: true,
                        buttons: {
                            Modificar: function (){
                                var observacion = $("#observacion").val();
                                var id_observaciones = $("#id_observaciones").val();
                                $.ajax({
                                method: "POST",
                                url: "includes/modificar_observaciones.php",
                                data: {id_observaciones: id_observaciones, observacion: observacion}
                            }).done(function (observacion) {
                                $('#observacion').html(observacion);
                            });   
                            }, 
                            Borrar: function (){
                                var id_observaciones = $("#id_observaciones").val();
                                $.ajax({
                                method: "POST",
                                url: "includes/borrar_observaciones.php",
                                data: {id_observaciones: id_observaciones}
                                }).done();            
                                $(this).dialog("close");
                            }
                        }
                    });                            
                });
            }

            function ver_perfil() {   

                $.ajax({                       
                    method: "POST",
                    url: "includes/ver_perfil.php"
                }).done(function (perfil) {
                    $('#perfil').html(perfil);
                });

                $("#perfil").dialog({
                    modal: true,
                    width: 450,
                    buttons: {
                        Modificar: function () {
                            var nombre = $("#nombre").val();
                            var apellidos = $("#apellidos").val();
                            var dni = $("#dni").val();
                            var ss = $("#ss").val();
                            var pass = $("#pass").val();
                            $.ajax({
                                method: "POST",
                                url: "includes/actualizar_perfil.php",
                                data: {nombre: nombre, apellidos: apellidos, dni: dni, ss: ss, pass: pass}
                            }).done(function (perfil2) {
                                $('#perfil').html(perfil2);
                            });
                        }
                    }                              
                });          
                
            }
           
            function mostrarPosicion(posicion) {
                latitud = posicion.coords.latitude;
                longitud = posicion.coords.longitude;
                if((latitud != 0) && (longitud != 0)){
                    $("#gps").html('<i class="fas fa-map-marker-alt"></i> Se ha optenido su posición');
                    $("#gps").removeClass('rojo');
                    $("#gps").addClass('verde');
                } else {
                    $("#gps").html('<i class="fas fa-exclamation-circle"></i> Su posición no ha sido determinada');
                    $("#gps").removeClass('verde');
                    $("#gps").addClass('rojo');                            
                }
                        /*
                         var precision = posicion.coords.accuracy;
                         var fecha = new Date(posicion.timestamp);
                         $('#posicion').append("Latitud: " + latitud + "");
                         $('#posicion').append("Longitud:" + longitud + "");
                         $('#posicion').append("Precisión: " + precision + " metros "); 
                         $('#posicion').append("Fecha: " + fecha + "");  
                        */ 
            }

            function mostrarErrores(error) {
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        alert('Permiso denegado por el usuario');
                        break;
                    case error.POSITION_UNAVAILABLE:
                        alert('Posición no disponible');
                        break;
                    case error.TIMEOUT:
                        alert('Tiempo de espera agotado');
                        break;
                    default:
                        alert('Error de Geolocalización desconocido :' + error.code);
                }
            }



            function ver_mapa(lon, lat) {   
                $("#dialog-mapa").dialog({
                    modal: true,
                    width: 325,
                });   
                mymap.invalidateSize();
                mymap.setView([lat, lon], 15);
                marker.setLatLng([lat, lon]);
            }

           
        </script>
	
	</head>
	
	<body class="is-preload" style="background-color: #4696e5;">

		<!-- Header -->
			<header id="header">
                           
                <p style="float: right;"><a style="cursor: pointer;" href="includes/cerrar_sesion.php">Cerrar Sesión <i class="fas fa-sign-out-alt"></i></a></p>
                <div class="content">
					<h1 style="text-align: center;"><abbr title="Gestionar contraseña"><i style="cursor: pointer" onclick="ver_perfil();" class="fas fa-user-edit"></i></abbr> HORA DE FICHAR</h1>
					<p style="text-align: center">Registre su entrada, descanso o salida pulsando el botón correspondiente</p>
					<ul class="actions">
						<li><a class="button primary" onclick="guardar(1);">
							<i class="fas fa-sign-in-alt"></i>  Comienzo de la jornada
						</a></li>
						<li><a class="button primary" onclick="guardar(2);">
							<i class="fas fa-coffee"></i>  Descanso
						</a></li>
						<li><a class="button primary" onclick="guardar(3);">
							<i class="fas fa-pause"></i>  Pausa
						</a></li>
						<li><a class="button primary"  onclick="guardar(4);">
							<i class="fas fa-user-md"></i>  Salida autorizada
						</a></li>
						<li><a class="button primary"  onclick="guardar(5);">
							<i class="fas fa-sign-out-alt"></i>  Fin de la jornada
						</a></li>						
					</ul>
				</div>
				<hr>
				<nav class = "content">
					<a class="button" style="max-width: 250px;
            margin: 0 auto;
            display: block;
			margin-bottom: 10px;"
			onclick="hoy()">
						<i class="fas fa-calendar-week"></i>
							 ÚLTIMOS SIETE DÍAS
					</a>	
					<div class="contenedor">
					<select style="margin-right: 1em" id="mes">
                            <option  selected=""  value="1">Enero</option>
                            <option  value="2">Febrero</option>
                            <option  value="3">Marzo</option>
                            <option  value="4">Abril</option>
                            <option  value="5">Mayo</option>
                            <option  value="6">Junio</option>
                            <option  value="7">Julio</option>
                            <option  value="8">Agosto</option>
                            <option  value="9">Septiembre</option>
                            <option  value="10">Octubre</option>
                            <option  value="11">Noviembre</option>
                            <option  value="12">Diciembre</option>
                        </select>
                        <select style="margin-right: 1em" id="ano">
							<option value="2019">2019</option>
							<option value="2020">2020</option>
                            <option value="2021">2021</option>
							<option  selected="" value="2022">2022</option>                        
						</select>                        
                        <a class="button" onclick="ver_mes();"><i class="far fa-calendar-alt"></i> MES</a>
					<div>
					</nav>	
			</header>	

		<!-- One -->
			<section id="html">
			</section>
				

		<div id="dialog-observaciones" title="Observaciones" class="invisible">
            <p>
                <h3><i class="fas fa-info"></i> Añadir Observaciones</h3>
                <textarea id='observaciones'></textarea>
            </p>

        </div>  

        <div id="dialog-observaciones-texto" title="Observaciones" class="invisible">
            <p id="observaciones-texto">
            </p>
        </div> 
        
        <div id="perfil" title="Usuario" class="invisible">
        </div>
                
        <div id="dialog-mapa" title="Posición" class="invisible">
        	<div id="mapas"></div>
        </div>

        <script>
            var mymap = L.map('mapas');
            mymap.locate({setView: true, maxZoom: 15}); 
            var marker = L.marker([longitud,latitud]).addTo(mymap);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 15,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox.streets'
            }).addTo(mymap);                                    
        </script>
            
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