<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();

/* Cambiamos el estado de CON/SIN manipulación de alimentos de la solicitud */
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $solicitud = $solicitudController->getSolicitudesWhereId($id);
    $manipulacion = $solicitud['tipo_empleo'];
    if($manipulacion === '0'){
        $manipulacion = 1;
    }
    else{
        $manipulacion = 0;
    }
    $params = [
        'tipo_empleo' => $manipulacion
    ];

    $sol = SolicitudController::update($params, $_POST['id']);
    echo ($manipulacion);
    exit();
}
