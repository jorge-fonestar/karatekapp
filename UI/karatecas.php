<h1>Karatecas</h1>
<div class="btn btn-evento" onclick='LoadKarateca("NEW")'> <span class="glyphicon glyphicon-plus"></span> Nuevo Karateca </div>

<?php

// Listado de Karatekas registrados
$SELECT = "SELECT * FROM KARATECAS WHERE ID_CLUB='$ID_CLUB' order by NOMBRE";
$data = seleccionar($SELECT);
if ($data) {
    while ($row = $data->fetch_assoc()){
        extract($row);
        ?>
        <div class="card mb-3 bg-dark text-white" style='width: 100%; cursor:pointer;' onclick='LoadKarateca("<?php echo $ID;?>")'>
            <div class="card-header">
                <span style='font-size:16px;'><?php echo $NOMBRE;?></span>
            </div>
        </div>
        <?php
    }
}
?>