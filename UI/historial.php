<div class='row'>
    <div class="col-xs-9"><h1>Combates</h1></div>
    <div class="col-xs-3"><div class="btn btn-evento" onclick='$("#mdlBuscar").modal("show");'> <span class="glyphicon glyphicon-search"></span> </div></div>
</div>
<?php
if ($FechaIni!='') $FILTROS .= " AND FECHA > '$FechaIni'";
if ($FechaFin!='') $FILTROS .= " AND FECHA < '$FechaFin'";
if ($IdTorneo!='') $FILTROS .= " AND ID_TORNEO = '$IdTorneo'";
if ($Ronda!='') $FILTROS .= " AND RONDA = '$Ronda'";
if ($Nombre!='') $FILTROS .= " AND (AO like '%$Nombre%' or AKA like '%$Nombre%') > '$IdTorneo'";

$SELECT = "SELECT * FROM COMBATES WHERE ID_CLUB='$ID_CLUB' $FILTROS";
$data = seleccionar($SELECT);
if ($data){
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
}
?>

<!-- Modal FILTROS -->
<div class="modal fade" id="mdlBuscar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style='text-align: left !important; margin-top: 80px;'>
        <div class="modal-body">
            <form id='frmFiltros'>
                Nombre karateca<br>
                <input type='text' name='Nombre' style='width:100%'><br><br>


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

                Torneo<br>
                <select name='IdTorneo' style='width:100%'>
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
                <select name='Ronda' style='width:100%'>
                    <option value=''>- Cualquiera -</option>
                    <option value='1'>Ronda 1</option>
                    <option value='2'>Ronda 2</option>
                    <option value='3'>Ronda 3</option>
                    <option value='4'>Ronda 4</option>
                    <option value='5'>Ronda 5</option>
                    <option value='6'>Ronda 6</option>
                    <option value='7'>Ronda 7</option>
                </select><br><br>
            </form>
        </div>
        <div class="modal-footer">
          <a class="btn btn-secondary left" href='menu'> Cancelar </a>
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick='$("#frmFiltros").submit();'>Aceptar</button>
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