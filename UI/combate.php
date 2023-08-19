
<!-- Incluimos los estilos personalizados -->
<link rel="stylesheet" href="UI/combate.css">
<script src="UI/combate.js"></script>

<?php 
if (isset($grabarCombate)){

  // Obtener las variables recibidas por POST
  $idTorneo = $_POST['IdTorneo'];
  $ronda = $_POST['Ronda'];
  $nombreAO = $_POST['NombreAO'];
  $nombreAKA = $_POST['NombreAKA'];
  $puntosAO = $_POST['PuntosAO'];
  $puntosAKA = $_POST['PuntosAKA'];
  $sensu = $_POST['sensu'];
  $registrosJSON = $_POST['RegistrosJSON'];
  
  // Convertir el registro JSON a un array de PHP
  $registros = json_decode($registrosJSON, true);

  // Crear la consulta INSERT
  $sql = "INSERT INTO `COMBATES`(`ID`, `ID_CLUB`, `ID_TORNEO`, `RONDA`, `AO`, `AKA`, `PUNTOS_AO`, `PUNTOS_AKA`, `SENSU`, `HANTEI`) VALUES (NULL, '$ID_CLUB', '$idTorneo', '$ronda', '$nombreAO', '$nombreAKA', '$puntosAO', '$puntosAKA', '$sensu', '$hantei')";
  ejecutar($sql);

  $idCombate = mysqli_insert_id($db);
  
  // Crear una consulta INSERT para cada registro de la array
  foreach ($registros as $registro) {
    $minuto = $registro['minuto'];
    $color = $registro['color'];
    $tecnica = $registro['tecnica'];
    $situacion = $registro['situacion'];

    $sqlRegistro = "INSERT INTO `REGISTROS`(`ID`, `ID_COMBATE`, `MINUTO`, `COLOR`, `TECNICA`, `SITUACION`) VALUES (NULL, '$idCombate', '$minuto', '$color', '$tecnica', '$situacion')";
    ejecutar($sqlRegistro);
  }

  echo "El combate ha sido registrado correctamente.";
  ?>
  <a class="btn btn-evento" href='historial'> <span class="glyphicon glyphicon-home"></span> Regresar </a>
  <?php
}else{
  ?>
  <script>
    document.addEventListener('touchmove', function(event) {
      event.preventDefault();
      event.stopPropagation();
    }, false);

    window.addEventListener('beforeunload', function(event) {
      // Cancelar la descarga de la página
      event.preventDefault();

      // Mostrar un mensaje de confirmación personalizado
      event.returnValue = '';
      return '';
    });

  </script>

  <div id='Color' style="display: none;"></div>
  <div id='Tipo' style="display: none;"></div>

  <div id='combate'>

    <!-- Marcador -->
    <div class="row">
      <div class="col-6 border-ao">
        AO
      </div>
      <div class="col-6 border-aka">
        AKA
      </div>
    </div>

    <div class="row">
      <div class="col-6 border-ao">
        <span id="sensu-AO" class="badge bg-dark rounded-circle" onclick="SensuSet(false)">&nbsp;</span>
        <h2 id='marcador-AO' class="scoreboard-number ao align-middle">0</h2>
        <div class="row justify-content-center" onclick="NuevoEvento('Amonestación', 'AO')">
          <div class="col-chui">
            <span id="bga-AO-1" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AO-2" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AO-3" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AO-4" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AO-5" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
        </div>
      </div>
      <div class="col-6 border-aka">
        <h2 id='marcador-AKA' class="scoreboard-number aka align-middle">0</h2>
        <span id="sensu-AKA" class="badge bg-dark rounded-circle" onclick="SensuSet(false)">&nbsp;</span>
        <div class="row justify-content-center" onclick="NuevoEvento('Amonestación', 'AKA')">
          <div class="col-chui">
            <span id="bga-AKA-1" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AKA-2" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AKA-3" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AKA-4" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
          <div class="col-chui">
            <span id="bga-AKA-5" class="bg-amonestacion badge bg-dark rounded-circle">&nbsp;</span>
          </div>
        </div>
      </div>
    </div>



    <!-- Botones -->
    <div class="row">
      <div class="col-6 border-ao">
        <div class="btn btn-evento" onclick="NuevoEvento('Ataque', 'AO')">Ataque</div> <br>
        <div class="btn btn-evento" onclick="NuevoEvento('Defensa', 'AO')">Defensa</div> <br>
        <div class="btn btn-evento" onclick="NuevoEvento('Amonestación', 'AO')">Amonestación</div> <br>
      </div>
      <div class="col-6 border-aka">
        <div class="btn btn-evento" onclick="NuevoEvento('Ataque', 'AKA')">Ataque</div> <br>
        <div class="btn btn-evento" onclick="NuevoEvento('Defensa', 'AKA')">Defensa</div> <br>
        <div class="btn btn-evento" onclick="NuevoEvento('Amonestación', 'AKA')">Amonestación</div> <br>
      </div>
    </div>

    <!-- Cronometro -->
    <div class="row">
    <div class="col-3"> <div class="btn btn-transparente" onclick="CountdownMenos()">-</div> </div>
      <div class="col-6"> <div id='timer'>03:00</div> </div>
      <div class="col-3"> <div class="btn btn-transparente" onclick="CountdownMas()">+</div> </div>
    </div>

    <!-- Opciones y Hajime/Yame -->
    <div class="row">
      <div class="col-3"> <div class="btn btn-evento" onclick="Menu()"> <span class="glyphicon glyphicon-ok-sign"></span> </div> </div>
      <div class="col-6"> <div id="btn-timer" class="btn btn-evento" onclick="startStopCountdown()">¡Hajime!</div> </div>
      <div class="col-3"> <div class="btn btn-evento" onclick="eliminarLinea()"> <span class="glyphicon glyphicon-step-backward"></span> </div> </div>
    </div>

    <!-- Registros -->
    <div class="row">
      <div class="col">
        <div class="row table-title">
          <div class="col-2">Min.</div>
          <div class="col-10">Tipo</div>
        </div>
        <div id="registros"></div>
      </div>
    </div>
  </div>
                                                          

  <!-- Modal Puntos -->
  <div class="modal fade" id="modal-evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <!-- Botones -->
          <div class="btn btn-modal" onclick="GrabarEvento('YUKO', 1)">Yuko</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('WAZARI', 2)">Wazari</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('IPPON-GERI', 3)"> Ipon Geri</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('IPPON-BARRIDO', 3)"> Ipon Barrido</div> <br>
          
          <div class="form-check" id='SensuDivOn'>
            <input class="form-check-input" type="checkbox" id="SensuOn" checked="checked">
            <label class="form-check-label" for="SensuON">Sensu</label>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Amonestación -->
  <div class="modal fade" id="modal-amonestacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <!-- Botones -->
          <div class="btn btn-modal" onclick="GrabarEvento('CHUI1', 1)">Chui 1</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('CHUI2', 2)">Chui 2</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('CHUI3', 3)">Chui 3</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('HANSOKU-CHUI', 4)">Hansoku Chui</div> <br>
          <div class="btn btn-modal" onclick="GrabarEvento('HANSOKU', 5)">Hansoku</div> <br>
          
          <div class="form-check" id='SensuDivOff' style="display:none">
            <input class="form-check-input" type="checkbox" id="SensuOff">
            <label class="form-check-label" for="SensuOFF">Quitar Sensu</label>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Menú -->
  <div class="modal fade" id="modal-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <!-- Botones -->
          <div class="btn btn-modal" onclick="GrabarCombate()">Grabar el combate</div> <br>
          <a class="btn btn-modal" href="menu">Salir sin grabar</a> <br>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal DEFINICIÓN -->
  <div class="modal fade" id="modal-definicion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style='text-align: left !important;'>
        <div class="modal-body">

          <!-- Botones -->
          Torneo<br>
          <select id='IdTorneo' style='width:100%'>
            <option value='0'>ENTRENAMIENTO / NO OFICIAL</option>
            <?php
            $SELECT = "SELECT * FROM TORNEOS WHERE ID_CLUB='$ID_CLUB' order by ID";
            $data = seleccionar($SELECT);
            if ($data) {
              while ($row = $data->fetch_assoc()){
                  extract($row);
                  echo "<option value='$ID'>$NOMBRE $CATEGORIA $PESO</option>";
              }
            }
            ?>
          </select><br><br>

          <div class="row">
            <div class="col-6">
              Ronda<br>
              <select id='Ronda' style='width:100%'>
                <option value='1'>Ronda 1</option>
                <option value='2'>Ronda 2</option>
                <option value='3'>Ronda 3</option>
                <option value='4'>Ronda 4</option>
                <option value='5'>Ronda 5</option>
                <option value='6'>Ronda 6</option>
                <option value='7'>Ronda 7</option>
              </select>
            </div>
            <div class="col-6">
              Minutos<br>
              <input id="timerIni" value='3'><br><br>
            </div>
          </div>
          

          

          Nombre AO<br>
          <input type='text' id='NombreAO' style='width:100%'><br><br>

          Nombre AKA<br>
          <input type='text' id='NombreAKA' style='width:100%'><br><br>

        </div>
        <div class="modal-footer">
          <a class="btn btn-secondary left" href='menu'> Cancelar </a>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='setTimerMin()'>Aceptar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- <script>$("#modal-definicion").modal("show");</script> -->

<?php }?>