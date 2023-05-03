<?php 
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


include "pag_cabecera.php";

### COMPROBACION DE SESION INICIADA ###

// ¿Intento de login?
if (isset($user_mail) && isset($user_pass) && $user_mail!=''){
        
    if (!$sesion->conectar($user_mail, $user_pass)){
        echo "<script>alert('El usuario o la contraseña son incorrectos. Por favor, intentalo de nuevo.'); location.href='".$config->url."'</script>";
    }
}

if (!$sesion->empezada()){
    include "landing.php";
    
}else{

    if ($ACCESO=='COMBATE'){    include "combate.php"; }
    elseif ($ACCESO=='TORNEOS'){    include "torneos.php"; }
    elseif ($ACCESO=='HISTORIAL'){    include "historial.php"; }
    elseif ($ACCESO=='KARATECAS'){  include "karatecas.php"; }
    elseif ($ACCESO=='STATS'){  include "stats.php"; }
    else {                      include "menu.php"; }

    
}

include "pag_pie.php";
db_desconectar();
?>