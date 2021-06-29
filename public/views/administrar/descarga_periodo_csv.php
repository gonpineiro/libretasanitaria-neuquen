<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();

// consultamos las solicitudes que ya fueron aprobadas o rechazadas para la vista de solicitudes por período 

if (isset($_POST['fecha_desde']) and isset($_POST['fecha_hasta'])) {
    $fecha_desde = str_replace("/", "-", $_POST['fecha_desde']);
    $fecha_hasta = str_replace("/", "-", $_POST['fecha_hasta']);
    $solicitudPeriodo = $solicitudController->getSolicitudesWherePeriodApproved($_POST['fecha_desde'], $_POST['fecha_hasta']);

    $fp = fopen("./csv/" . 'solicitudes.csv', "w+");
    $header = [
        'numero solicitud', 'nombre solicitante', 'dni', 'fecha nacimiento', 'direccion', 'telefono', 'telefono actualizado', 'email', 'email actualizado', 'tipo empleo', 'renovacion', 'numero recibo', 'fecha expedicion', 'fecha vencimiento', 'observaciones', 'admin evaluador', 'retira en', 'estado'
    ];

    // Headers    
    fputcsv($fp, $header);

    // Data, Records
    while ($row = odbc_fetch_array($solicitudPeriodo)) {
        fputcsv($fp, array_values($row));
    }
    die;
    fclose($fp);
    exit();
}
