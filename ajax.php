<?php 

if (isset($LoadCombate)){
    header('Content-type: application/json');
    $SQLWEB="SELECT P.NOMBRE, P.PUBLICO FROM PRODUCTOS AS P WHERE P.NOMBRE != ''";
    $dataQueryWeb = seleccionar_web($SQLWEB);  
    while ($rowweb = $dataQueryWeb->fetch_assoc()) {
        extract($rowweb);
        $JSON['AO'] = $ITM_0;
        $JSON['AKA'] = $DESCRIP_0;
        $JSON['Lineas'] = $arrItm;
    }
    echo json_encode($JSON);
}

?>