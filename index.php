<?php 
header("Cache-Control: post-check=0, pre-check=0",false);
session_cache_limiter("must-revalidate"); 
session_start();
date_default_timezone_set("Europe/Madrid");


extract($_REQUEST);

include 'funciones.php';
//include 'clases.php';


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
    header('Location: /');
    exit;
}


### COMPROBACION DE SESION INICIADA ###


// ¿Intento de login?
if (isset($user_mail) && isset($user_pass) && $user_mail!=''){
        
    if (!$sesion->conectar($user_mail, $user_pass)){
        db_desconectar();
        echo "<script>alert('El usuario o la contraseña son incorrectos. Por favor, intentalo de nuevo.'); location.href='".$config->url."'</script>";
        exit;
    }
}

if (!$sesion->empezada()){
    ?>
    <div id="login" style="width: 400px; margin:auto; font-family: Arial, Helvetica, sans-serif;">
        <h2>Acceso de entrenador</h2>
        <form method="post">
            <table>
                <TR valign="middle">
                    <TD>Usuario</TD>
                    <TD><input size=16 type="text" name="user_mail" style='width:100%'></TD>
                </TR>
                <TR valign="middle">
                    <TD>Clave</TD>
                    <TD><input size=16 type="password" name="user_pass" style='width:100%'></TD>
                </TR>
                <TR valign="middle">
                    <TD colspan="2" align="center"><input type="submit" value="Acceder" style='width:100%'/></TD>
                </TR>
            </table>
        </form>
    </div>
    <br><br><br>

    <?php
}else{

    include "pag_cabecera.php";

    if ($ACCESO=='COMBATE'){    include "combate.php"; }
    elseif ($ACCESO=='TORNEOS'){    include "torneos.php"; }
    elseif ($ACCESO=='HISTORIAL'){    include "historial.php"; }
    elseif ($ACCESO=='STATS'){  include "stats.php"; }
    else {                      include "menu.php"; }

    include "pag_pie.php";
}


db_desconectar();
?>