<?php

include_once '../../../app/config/config.php';

if (isset($_GET['solicitud'])) {
    $id = $_GET['solicitud'];
    $solicitudController = new SolicitudController();
    $solicitud = $solicitudController->getSolicitudesWhereId($id);

    $nombre = $solicitud['nombre_te'];
    $dni = $solicitud['dni_te'];
    $emision = $solicitud['fecha_evaluacion'];
    $vencimiento = $solicitud['fecha_vencimiento'];
    $observaciones = $solicitud['observaciones'];

    $arrayFechas = compararFechas($vencimiento, 'days');
    if ($arrayFechas['date'] <= $arrayFechas['now']) {
        $vigencia = 'Vencido';
        $borderColor = '#ff7878';
        $backColor = '#ffa9a9';
        $fontColor = '#820000';
        
    } else {
        $borderColor = '#C9E4CD';
        $backColor = '#D8ECDB';
        $fontColor = '#2A562A';
        $vigencia = 'Vigente';
    }
} else {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>Solicitud - <?= $id ?></title>
    <link rel="stylesheet" href="./style.css">

    <style>
        .card {
            border-color: <?= $borderColor ?>;
            background-color: <?= $backColor ?>;
            color: <?= $fontColor ?>;
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <img class="full_width" src="../../estilos/carnet/banner.jpeg" alt="" srcset="">

        <div class="detalle d-flex flex-column justify-content-center align-items-center">
            <h4><?= $nombre ?></h4>
            <p>Apellido, nombre</p>

            <h4><?= $id ?></h4>
            <p>Nro de Carnet</p>

            <h4><?= $dni ?></h4>
            <p>Documento</p>

            <h4><?= $emision ?></h4>
            <p>Fecha de Emisión</p>

            <h4><?= $vencimiento ?></h4>
            <p>Fecha de Vencimiento</p>

            <h4><?= $observaciones ?></h4>
            <p>Observaciones</p>
        </div>

        <div class="card d-flex flex-column justify-content-center align-items-center">
            <?= $vigencia ?>
        </div>

    </div>
</body>

</html>