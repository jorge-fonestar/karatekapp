<?php 

// Código para mostrar TODOS los errores:
if (isset($_REQUEST['debug'])){
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    echo "<h4 style='width:200px;margin:auto;'>DEBUG MODE:ON</h4>";
}

header("Cache-Control: post-check=0, pre-check=0",false);
session_cache_limiter("must-revalidate"); 
session_start();
date_default_timezone_set("Europe/Madrid");


extract($_REQUEST);

include 'funciones.php';

db_conectar();
$sesion = new sesion;
$ACCESO = strtoupper($ACCESO);

if ($ACCESO=='AJAX'){
    include "ajax.php";
    db_desconectar();
    exit;
}

if ($ACCESO=='SALIR') {
    $sesion->desconectar();
    db_desconectar();
    header('Location: '.$config->url);
    exit;
}


### COMPROBACION DE SESION INICIADA ###

// ¿Intento de login?
if (isset($user_mail) && isset($user_pass) && $user_mail!=''){
        
    if (!$sesion->conectar($user_mail, $user_pass)){
        echo "<script>alert('El usuario o la contraseña son incorrectos. Por favor, intentalo de nuevo.'); location.href='".$config->url."'</script>";
    }
}

if (!$sesion->empezada()){
    include "UI/login.php";
    
}else{
    ?>
    <!DOCTYPE html>
    <html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7; IE=EmulateIE9" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <meta name="HandheldFriendly" content="True" />
        <meta name="MobileOptimized" content="400" />
        <meta name="robots" content="none" />

        <meta charset="UTF-8">
        <title>Karatekapp</title>
        <link rel="shortcut icon" href="fabicon.ico" type="image/ico">
        <script src="https://kit.fontawesome.com/21eec419c8.js" crossorigin="anonymous"></script>
        
        <!-- Incluimos los estilos de Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

        <!-- JQuery -->   
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script> -->

        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        
        <!-- BootStrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Incluimos los estilos personalizados -->
        <link rel="stylesheet" href="estilos.css">
        <script src="funciones.js"></script>

    </head>
    <body>

        <!-- Barra Loading -->
        <div id="loading-overlay" class="loading-overlay">
            <div class="loading-icon"></div>
        </div>

        <!-- Contenedor para Mensajes -->
        <div id="Alert" class="alert fixed-top clickable" onclick="$('#Alert').css('display', 'none');">
            <div id="AlertContainer"> Mensaje a mostrar en el Aviso.</div>
        </div>

        <!-- Contenidos -->
        <div id='karatecas' class='content'><?php include "UI/karatecas.php";?></div>
            <div id='karateca' class='content'><?php include "UI/karateca.php";?></div>

        <div id='historial' class='content'><?php include "UI/historial.php";?></div>
            <div id='historial-search' class='content'><?php include "UI/historial_search.php";?></div>
        
        <div id='combate-def' class='content'><?php include "UI/combate_def.php";?></div>
            <div id='combate' class='content'><?php include "UI/combate.php";?></div>

        <div id='torneos' class='content'><?php include "UI/torneos.php";?></div>
            <div id='torneo' class='content'><?php include "UI/torneo.php";?></div>

        <div id='perfil' class='content'><?php include "UI/perfil.php";?></div>

        <?php include "UI/menu.php";?>


        <!-- VUE -->
        <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
        <script src="vue.js"></script>
    </body>
    </html>
    <?php
}

db_desconectar();
?>