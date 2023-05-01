<script src="historial.js"></script>
<div class='row'>
    <div class="col-xs-3"><a class="btn btn-evento" href='menu'> <span class="glyphicon glyphicon-menu-hamburger"></span> </a></div>
    <div class="col-xs-6"><h1>Historial</h1></div>
    <div class="col-xs-3"><div class="btn btn-evento" onclick='$("#mdlBuscar").modal("show");'> <span class="glyphicon glyphicon-search"></span> </div></div>
</div>
<?php
$SELECT = "SELECT * FROM COMBATES WHERE ID!=0 $FILTROS";
$data = seleccionar($SELECT);
while ($row = $data->fetch_assoc()){
    extract($row);
    ?>
    <div class="card mb-3 bg-dark text-white" style='width: 100%; cursor:pointer;' onclick='LoadCombate("<?php echo $ID;?>")'>
        <div class="card-header">
            <?php echo date('Y-m-d', strtotime($FECHA)); ?>
            <span style='font-size:16px;'><?php echo date('(H:i)', strtotime($FECHA)); ?></span>
        </div>
        <div class="card-body text-light">
            <div class="row">
                <div class="col-xs-4">
                    <h5 class="card-title ao"><?php echo $AO; ?></h5>
                </div>
                <div class="col-xs-4">
                    <span class='ao scoreboard-number scoreboard-number-list'><?php echo $PUNTOS_AO;?></span> - <span class='aka scoreboard-number scoreboard-number-list'><?php echo $PUNTOS_AKA;?></span>
                </div>
                <div class="col-xs-4">
                    <h5 class="card-title aka"><?php echo $AKA; ?></h5>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<!-- Modal FILTROS -->
<div class="modal fade" id="mdlBuscar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style='text-align: left !important; margin-top: 80px;'>
        <div class="modal-body">
            <form>
                Fechas entre<br>
                <div class="row">
                    <div class="col-xs-5">
                        <input type='date' name='FechaIni' style='width:100%'><br><br>
                    </div>
                    <div class="col-xs-2">
                        y
                    </div>
                    <div class="col-xs-5">
                        <input type='date' name='FechaFin' style='width:100%'><br><br>
                    </div>
                </div>
                <input type='text' id='NombreAO' style='width:100%'><br><br>

                Torneo<br>
                <select name='IdTorneo' style='width:100%'>
                    <?php
                    // Consulta de torneos de BDD
                    echo "<option value='$ID'>$NOMBRE Camargo Marzo 2023</option>";
                    ?>
                </select><br><br>

                Ronda
                <select name='Ronda' style='width:100%'>
                    <option value='1'>Ronda 1</option>
                    <option value='2'>Ronda 2</option>
                    <option value='3'>Ronda 3</option>
                    <option value='4'>Ronda 4</option>
                    <option value='5'>Ronda 5</option>
                    <option value='6'>Ronda 6</option>
                    <option value='7'>Ronda 7</option>
                </select><br><br>

                Nombre AO<br>
                <input type='text' name='NombreAO' style='width:100%'><br><br>

                Nombre AKA<br>
                <input type='text' name='NombreAKA' style='width:100%'><br><br>
            </form>
        </div>
        <div class="modal-footer">
          <a class="btn btn-secondary left" href='menu'> Cancelar </a>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='setTimerMin()'>Aceptar</button>
        </div>
      </div>
    </div>
  </div>