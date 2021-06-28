<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();

// consultamos las solicitudes que ya fueron aprobadas o rechazadas para la vista de solicitudes por período 

if (isset($_POST['fecha_desde']) and isset($_POST['fecha_hasta'])) {
    $fecha_desde = str_replace("/", "-", $_POST['fecha_desde']);
    $fecha_hasta = str_replace("/", "-", $_POST['fecha_hasta']);
    $solicitudPeriodo = $solicitudController->getSolicitudesWherePeriodApproved($_POST['fecha_desde'], $_POST['fecha_hasta']);
    //print_r($fecha_hasta);
    //die();
    //echo (utf8_converter($solicitudPeriodo, true));

    $file_name = 'solicitudes-'. $fecha_desde.'-'. $fecha_hasta.'.csv';
    $csv = '.csv';
    $date = date('Y-m-d');
    header("Content-Type: text/csv;charset=utf-8");
    header("Content-Disposition: attachment;filename=\"$file_name$csv\"");
    header("Content-Transfer-Encoding: binary");
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$date} GMT");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    //$fp = fopen('php://output' . 'data.csv', 'w');
    //$fp = fopen("./csv/" . "".$file_name."", "w+");
    $fp = fopen("./csv/" . 'solicitudes.csv', "w+");
    $header = [
        'numero solicitud', 'nombre solicitante', 'dni', 'fecha nacimiento', 'direccion', 'telefono', 'telefono actualizado', 'email', 'email actualizado', 'tipo empleo', 'renovacion', 'numero recibo', 'fecha expedicion', 'fecha vencimiento', 'observaciones', 'admin evaluador', 'estado'
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
