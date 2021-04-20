<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();
$solicitud = $solicitudController->getSolicitudesWhereId($_GET['id']);

echo (json_encode($solicitud));
