<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();

/* Cambiamos el estado de CON/SIN manipulación de alimentos de la solicitud */
if (isset($_POST['id'])) {
    $solicitud = $solicitudController->getSolicitudesWhereId($_POST['id']);
    $params = [
        'observaciones' => $_POST['observaciones']
    ];

    $sol = SolicitudController::update($params, $_POST['id']);
    exit();
}
