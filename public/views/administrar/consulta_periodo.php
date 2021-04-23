<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();

// consultamos las solicitudes que ya fueron aprobadas o rechazadas para la vista de solicitudes por período 

if (isset($_POST['fecha_desde']) AND isset($_POST['fecha_hasta']))  {
    $fecha_desde = $_POST['fecha_desde'];
    $fecha_hasta = $_POST['fecha_hasta'];
    $solicitudPeriodo = $solicitudController->getSolicitudesWherePeriod($fecha_desde, $fecha_hasta);
    echo (utf8_converter($solicitudPeriodo, true));
    exit();
} 
