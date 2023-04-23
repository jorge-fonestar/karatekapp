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
  </div>
  <div class="col-6 border-aka">
    <div class="btn btn-evento" onclick="NuevoEvento('Ataque', 'AKA')">Ataque</div> <br>
    <div class="btn btn-evento" onclick="NuevoEvento('Defensa', 'AKA')">Defensa</div> <br>
  </div>
</div>

<!-- Cronometro -->
<div class="row">
  <div class="col-3"> <a class="btn btn-evento" href='menu'> <span class="glyphicon glyphicon-home"></span> </a> </div>
  <div class="col-6"> <div id='timer'>03:00</div> </div>
  <div class="col-3"> <div class="btn btn-evento" onclick="GrabarCombate()"> <span class="glyphicon glyphicon-download-alt"></span> </div> </div>
</div>

<div class="row">
  <div class="col-3"> <div class="btn btn-evento" onclick="CountdownMenos()">-</div> </div>
  <div class="col-6"> <div id="btn-timer" class="btn btn-evento" onclick="startStopCountdown()">¡Hajime!</div> </div>
  <div class="col-3"> <div class="btn btn-evento" onclick="CountdownMas()">+</div> </div>
</div>

<!-- Registros -->
<div class="row">
  <div class="col">
    <div class="row table-title">
      <div class="col-2">Minuto</div>
      <div class="col-8">Tipo</div>
      <div class="col-2">Pts</div>
    </div>
    <div class="registros"></div>
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


<!-- Modal DEFINICIÓN -->
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
