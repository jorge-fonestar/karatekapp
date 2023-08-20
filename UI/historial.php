<h1>Combates</h1>
<div class="btn btn-light" onclick='nav("historial-search")'> <span class="glyphicon glyphicon-search"></span> Buscar </div><br><br>

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