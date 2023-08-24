<h1>Combate registrado</h1>
<div class="btn btn-light" onclick='loadKaratecas(); nav("karatecas")'> <span class="glyphicon glyphicon-chevron-left"></span> Atras </div><br><br>

    <div class="row">
      {{ FECHA }} <span style="font-size: 16px;">({{ HORA }})</span>
    </div>
    
    
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
