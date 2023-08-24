<h1>Nuevo combate</h1>
          
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
<div class="input-group" style='width:100%'>
  <input type="text" id="NombreAO" class="autocomplete-karateca ui-autocomplete-input" style="width: calc(100% - 45px);" autocomplete="off">
  <button id="btnSelectAO" class="btn btn-desplegar" type="button"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
</div><br><br>


Nombre AKA<br>
<div class="input-group" style='width:100%'>
  <input type="text" id="NombreAKA" class="autocomplete-karateca ui-autocomplete-input" style="width: calc(100% - 45px);" autocomplete="off">
  <button id="btnSelectAKA" class="btn btn-desplegar" type="button"><i class="fa fa-angle-down" aria-hidden="true"></i></button>
</div><br><br>


<button type="button" class="btn btn-primary" data-dismiss="modal" onclick='ComenzarCombate()'>¡Comenzar!</button>