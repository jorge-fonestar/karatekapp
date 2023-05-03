<?php 

if (isset($LoadCombate)){
    //header('Content-type: application/json');
    $SQLWEB="SELECT * FROM REGISTROS WHERE ID_COMBATE = '$LoadCombate'";
    $dataQueryWeb = seleccionar($SQLWEB);  
    while ($rowweb = $dataQueryWeb->fetch_assoc()) {
        extract($rowweb);
        echo "<div class='row ".strtolower($COLOR)."'>
                <div class='col-2'>$MINUTO</div>
                <div class='col-10'>$TECNICA en $SITUACION</div>
            </div>";
    }
}

?>