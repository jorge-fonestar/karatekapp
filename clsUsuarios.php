<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clsUsuarios
 *
 * @author jorbi
 */
class clsUsuario {
    private $ID;
    private $NOMBRE;
    private $EMAIL;
    private $ID_GRUPO;
    
    function __construct($ID=''){
        if ($ID!='') $this->loadByID($ID);
    }
    
    function loadByID($ID){
        $sql="SELECT * FROM USUARIOS WHERE ID = '$ID'";
        $row = seleccionar_una($sql);
        
        if ($row!=''){
            extract($row);

            $this->ID = $ID;
            $this->NOMBRE = $NOMBRE;
            $this->EMAIL = $EMAIL;
            $this->ID_GRUPO = $ID_GRUPO;
            return true;
        }else{
            return false;
        }
    }
    
    function loadByEmail($Email){
        $Email = trim($Email);
        $sql="SELECT ID FROM USUARIOS WHERE EMAIL like '$Email'";
        $MI_GRUPO = $_SESSION['GRUPO']['ID'];
        if ($MI_GRUPO!='') $sql.= " and ID_GRUPO = '$MI_GRUPO'";
        
        $row = seleccionar_una($sql);
        if ($row!=''){
            extract($row);
            return $this->loadByID($ID);
        }else{
            return false;
        }
    }
    
    function getID(){ return $this->ID; }
    function getNOMBRE(){ return $this->NOMBRE; }
    function getEMAIL(){ return $this->EMAIL; }
    function getID_GRUPO(){ return $this->ID_GRUPO; }
}


function CrearUsuario($ID_GRUPO, $Nombre, $Email, $Pass, $Tel='', $Admin=0, $Zona='', $Direccion='', $DNI='', $Observaciones='', $Saldo=0, $Validado=0){

    $Pass = md5($Pass);
    $sql = "INSERT INTO USUARIOS VALUES ('', '$Nombre', '$Email', '$Tel', '$Pass', '$ID_GRUPO', '$Admin', '$Validado', '$Zona', '$Direccion', '$DNI', '$Observaciones', '$Saldo');";
    //echo "SQL: $sql";
    //exit;
    $NuevoID = ejecutar($sql);

    action_log("USUARIO SOLICITADO: $Email", $ID_GRUPO);

    $oGrupo = new clsGrupo($ID_GRUPO);

    // Si el grupo es abierto, enviamos el mail de validación final al usuario,
    if ($oGrupo->getConfig_VALIDACION_NECESARIA()!='1'){
        $AVISO = translate('ULTIMO_PASO');
        $Codigo = md5(md5($NuevoID));
        $mail = "<style>.boton{padding:10px; background-color:#6E6; color: #fff; text-decoration:none;}</style>"
            . "<h2>".translate('CONFIRMA_SUSCRIPCION').$oGrupo->getNOMBRE()." </h2>"
            . "<a class='boton' href='".$config->url."/alta_usuario.php?confirm=$Codigo&user=$NuevoID&ID_GRUPO=$ID_GRUPO'> ".translate('CONFIRMAR')." </a>"
            . "<p>".translate('SI_MAIL_POR_ERROR')."</p>"
            . "<p>".translate('SI_TIENES_DUDAS')."</p>";
        enviar_mail($Email, translate('ALTA_USUARIO'), $mail);

    // Si el grupo es cerrado, el mail debe enviarse al ADMIN, y con los datos del usuario
    }else{                   
        $data_subgrupos = seleccionar_una("SELECT NOMBRE as NOMBRE_ZONA FROM SUBGRUPOS WHERE ID = '$ID_SUBGRUPO'");        
        extract($data_subgrupos);
        $AVISO = translate('SE_HA_CURSADO');
        $Codigo = md5(md5($NuevoID));
        $mail = "<style>.boton{padding:10px; background-color:#6E6; color: #fff; text-decoration:none;}</style>"
            . translate('PIDEN_UN_USUARIO')
            . "<p>GRUPO: ".$oGrupo->getNOMBRE()."</p>"
            . "<p>".translate('NOMBRE').": ".$Nombre."</p>"
            . "<p>".translate('ZONA').": ".$NOMBRE_ZONA."</p>"
            . "<p>".translate('DIRECCION').": ".$Direccion."</p>"
            . "<p>".translate('TELEFONO').": ".$Tel."</p>"
            . "<p>".translate('CORREO').": ".$Email."</p>";
        
        $mail = $mail . "<a class='boton' href='".$config->url."/alta_usuario.php?aprobar=$Codigo&user=$NuevoID&ID_GRUPO=$ID_GRUPO'> ".translate('CONFIRMAR')." </a>";
        enviar_mail($oGrupo->getConfig_EMAIL_PPAL(), 'Solicitud alta de usuario', $mail);
    }
    
    return $NuevoID;
}

function ValidarUsuario($user){
    $sql="UPDATE USUARIOS SET ESTADO='1' WHERE ID='$user'";
    ejecutar($sql);
    
    $oUser = new clsUsuario($user);
    $ID_GRUPO = $oUser->getID_GRUPO();
    $oGrupo = new clsGrupo($ID_GRUPO);
    
    action_log("ALTA DE USUARIO: ".$oUser->getNOMBRE()."; eMail: ".$oUser->getEMAIL(), $ID_GRUPO);

    $mail = "Hola, <p> ".$oUser->getNOMBRE()." acaba de confirmar su acceso de usuario a ".$oGrupo->getNOMBRE()." con el correo: ".$oUser->getEMAIL()." </p> Salu2 automáticos ^^)";
    enviar_mail($oGrupo->getConfig('EMAIL_PPAL'), 'Alta de usuario', $mail);
    //enviar_mail('namaste.jorge@gmail.com', 'Alta de usuario', $mail);
    
    return true;
}