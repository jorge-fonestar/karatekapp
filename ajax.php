<?php 

// Combates
if (isset($loadHistorial)) loadHistorial($filtros);
if (isset($LoadCombate)) LoadCombate($LoadCombate);

if (isset($GrabarCombate)) GrabarCombate($Data);



// Karatekas
if (isset($ListadoKaratecas)) ListadoKaratecas();
if (isset($LoadKarateca)) LoadKarateca($LoadKarateca);
if (isset($GrabarKarateca)) GrabarKarateca($Data);






function loadHistorial($filtros=''){
  global $ID_CLUB;
  extract($filtros);
  if ($Nombre!='') $FILTROS .= " AND (AO like '%$Nombre%' or AKA like '%$Nombre%')";
  if ($FechaIni!='') $FILTROS .= " AND FECHA > '$FechaIni'";
  if ($FechaFin!='') $FILTROS .= " AND FECHA < '$FechaFin'";
  if ($IdTorneo!='') $FILTROS .= " AND ID_TORNEO = '$IdTorneo'";
  if ($Ronda!='') $FILTROS .= " AND RONDA = '$Ronda'";
  
  $DATA = array();
  $SELECT = "SELECT * FROM COMBATES WHERE ID_CLUB='$ID_CLUB' $FILTROS ORDER BY FECHA DESC";
  $data = seleccionar($SELECT);
  if ($data){
    while ($row = $data->fetch_assoc()){
      $row = array_map('utf8_encode', $row);

      $timestamp = strtotime($row['FECHA']);
      $row['FECHA'] = date("Y-m-d", $timestamp);
      $row['HORA'] = date("H:i:s", $timestamp);
      
      $DATA[] = $row;
    }
  }
  echoJSON($DATA);
}

function ListadoKaratecas(){
  global $ID_CLUB;
  $SELECT = "SELECT * FROM KARATECAS WHERE ID_CLUB='$ID_CLUB' order by NOMBRE";
  $data = seleccionar($SELECT);
  if ($data) {
    while ($row = $data->fetch_assoc()){
      $row = array_map('utf8_encode', $row);
      $DATA[] = $row;
    }
  }
  echoJSON($DATA);
}

function GrabarCombate($Data){
  global $db;
  global $ID_CLUB;

  $Ok = 1;

  // Obtener las variables recibidas por POST
  $idTorneo = $Data['IdTorneo'];
  $ronda = $Data['Ronda'];
  $nombreAO = $Data['NombreAO'];
  $nombreAKA = $Data['NombreAKA'];
  $puntosAO = $Data['PuntosAO'];
  $puntosAKA = $Data['PuntosAKA'];
  $sensu = $Data['Sensu'];
  $registros = $Data['Registros'];
  
  // Crear la consulta INSERT
  $sql = "INSERT INTO `COMBATES`(`ID`, `ID_CLUB`, `ID_TORNEO`, `RONDA`, `AO`, `AKA`, `PUNTOS_AO`, `PUNTOS_AKA`, `SENSU`, `HANTEI`) VALUES (NULL, '$ID_CLUB', '$idTorneo', '$ronda', '$nombreAO', '$nombreAKA', '$puntosAO', '$puntosAKA', '$sensu', '$hantei')";
  $Ok *= ejecutar($sql);

  $idCombate = mysqli_insert_id($db);
  
  // Crear una consulta INSERT para cada registro de la array
  foreach ($registros as $registro) {
    $minuto = $registro['minuto'];
    $color = $registro['color'];
    $tecnica = $registro['tecnica'];
    $situacion = $registro['situacion'];

    $sqlRegistro = "INSERT INTO `REGISTROS`(`ID`, `ID_COMBATE`, `MINUTO`, `COLOR`, `TECNICA`, `SITUACION`) VALUES (NULL, '$idCombate', '$minuto', '$color', '$tecnica', '$situacion')";
    $Ok *= ejecutar($sqlRegistro);
  }

  echo $Ok;
  ?>
  <a class="btn btn-light" href='historial'> <span class="glyphicon glyphicon-home"></span> Regresar </a>
  <?php
}

function LoadCombate($LoadCombate){
  //header('Content-type: application/json');
  $SQLWEB="SELECT * FROM REGISTROS WHERE ID_COMBATE = '$LoadCombate'";
  $dataQueryWeb = seleccionar($SQLWEB);  
  while ($rowweb = $dataQueryWeb->fetch_assoc()) {
      extract($rowweb);
      echo "<div class='".strtolower($COLOR)."'>$MINUTO - $TECNICA en $SITUACION</div>";
  }
}

function LoadKarateca($LoadKarateca){
  //header('Content-type: application/json');
  $SQLWEB="SELECT * FROM KARATECAS WHERE ID = '$LoadKarateca'";
  $row = seleccionar_una($SQLWEB);  
  $row = array_map('utf8_encode', $row);
  $DATA = $row;

  //TODO: Calcular Estadísticas
  $DATA['Estadisticas'] = "Calculadas aparte";

  echoJSON($DATA);
}

function GrabarKarateca($Data) {
    global $ID_CLUB;
    extract($Data);
    
    if ($ID=='NEW'){
      $sql = "INSERT INTO `KARATECAS`(`ID`, `ID_CLUB`, `DNI`, `NOMBRE`, `FECHA_NACIMIENTO`, `TELEFONO`, `SEXO`, `CINTURON`) VALUES (NULL, '$ID_CLUB', '$DNI', '$NOMBRE', '$FECHA_NACIMIENTO', '$TELEFONO', '$SEXO', '$CINTURON')";
      
    } else {
      $sql = "UPDATE `KARATECAS` 
                SET DNI='$DNI', NOMBRE='$NOMBRE', FECHA_NACIMIENTO='$FECHA_NACIMIENTO', TELEFONO='$TELEFONO', SEXO='$SEXO', CINTURON='$CINTURON' 
                WHERE ID='$ID'";
    }
    if (ejecutar($sql)){
      echo "1";

    }else{
      global $db;
      echo $db->error;

    }
}
?>