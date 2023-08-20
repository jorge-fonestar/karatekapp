<h1>Buscar combates</h1>
<div class="btn btn-light" onclick='nav("historial")'> <span class="glyphicon glyphicon-chevron-left"></span> Atras </div><br><br>


Nombre karateca<br>
<input id='srchNombre' type='text' name='Nombre' style='width:100%'><br><br>


Fechas entre<br>
<div class="row">
    <div class="col-xs-5">
        <input type='date' id='srchFechaIni' name='FechaIni' style='width:100%'><br><br>
    </div>
    <div class="col-xs-2">
        y
    </div>
    <div class="col-xs-5">
        <input type='date' id='srchFechaFin' name='FechaFin' style='width:100%'><br><br>
    </div>
</div>

Torneo<br>
<select id='srchIdTorneo' name='IdTorneo' style='width:100%'>
    <option value=''>- Cualquiera -</option>
    <option value='0'>ENTRENAMIENTO / NO OFICIAL</option>
    <?php
    $SELECT = "SELECT * FROM TORNEOS WHERE ID_CLUB='$ID_CLUB' order by ID";
    $data = seleccionar($SELECT);
    if ($data){
        while ($row = $data->fetch_assoc()){
            extract($row);
            echo "<option value='$ID'>$NOMBRE $CATEGORIA $PESO</option>";
        }
    }
    ?>
</select><br><br>

Ronda
<select id='srchRonda' name='Ronda' style='width:100%'>
    <option value=''>- Cualquiera -</option>
    <option value='1'>Ronda 1</option>
    <option value='2'>Ronda 2</option>
    <option value='3'>Ronda 3</option>
    <option value='4'>Ronda 4</option>
    <option value='5'>Ronda 5</option>
    <option value='6'>Ronda 6</option>
    <option value='7'>Ronda 7</option>
</select><br><br>

<div class="btn btn-light" onclick='loadHistorial(); nav("historial")'><span class="glyphicon glyphicon-search"></span> Buscar</div>