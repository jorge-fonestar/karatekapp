<h1>Torneos</h1>

<?php
$SELECT = "SELECT * FROM TORNEOS WHERE ID_CLUB='$ID_CLUB' order by ID";
$data = seleccionar($SELECT);
if ($data) {
    while ($row = $data->fetch_assoc()){
        extract($row);
        echo "<div onclick='editarTorneo(\"$ID\")'>$NOMBRE $CATEGORIA $PESO</div>";
    }
}
?>
<a class="btn btn-evento" href='menu'> <span class="glyphicon glyphicon-plus"></span> Nuevo Torneo </a>
<a class="btn btn-evento" href='menu'> <span class="glyphicon glyphicon-home"></span> Regresar </a>