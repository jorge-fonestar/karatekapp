<h1>Combates</h1>
<div class="btn btn-light" onclick='nav("historial-search")'> <span class="glyphicon glyphicon-search"></span> Buscar </div><br><br>

  <!-- Utiliza v-for para iterar sobre la lista de combates -->
  <div class="card mb-3 bg-dark text-white clickable" v-for="combate in combates" :key="combate.id" @click="loadCombate(combate.ID)">
    <div class="card-header">
      {{ combate.FECHA }} <span style="font-size: 16px;">({{ combate.HORA }})</span>
    </div>
    <div class="card-body text-light">
      <div class="row">
        <div class="col-xs-4">
          <h5 class="card-title ao">{{ combate.AO }}</h5>
        </div>
        <div class="col-xs-4">
          <span class="ao scoreboard-number scoreboard-number-list">{{ combate.PUNTOS_AO }}</span> - <span class="aka scoreboard-number scoreboard-number-list">{{ combate.PUNTOS_AKA }}</span>
        </div>
        <div class="col-xs-4">
          <h5 class="card-title aka">{{ combate.AKA }}</h5>
        </div>
      </div>
    </div>
  </div>


<!-- Modal Detalles -->
<div class="modal fade" id="mdlDetalles" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style='text-align: left !important; margin-top: 80px;'>
        <div class="modal-body" id='divDetalles'>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
</div>