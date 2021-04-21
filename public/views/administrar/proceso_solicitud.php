<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();


/* Consultamos para el modal */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $solicitud = $solicitudController->getSolicitudesWhereId($id);

    /* busca la foto dni */
    $genero = $solicitud['genero_te'];
    $dni = $solicitud['dni_te'];

    $response = file_get_contents('https://weblogin.muninqn.gov.ar/api/Renaper/waloBackdoor/' . $genero . $dni);
    $json = json_decode($response);
    $imagen = $json->{'docInfo'}->{'imagen'};

    /*  si la imagen retorna NULL fuerzo su búsqueda con @F al final de la url */
    if (is_null($imagen)) {
        $response = file_get_contents('https://weblogin.muninqn.gov.ar/api/Renaper/waloBackdoor/' . $genero . $dni . "@F");
        $json = json_decode($response);
        $imagen = $json->{'docInfo'}->{'imagen'};
    }
    $solicitud['imagen'] = $imagen;
    echo utf8_converter($solicitud, true);
    $asd = utf8_converter($solicitud, true);
    exit();
}

/* Aprobamos o rechazamos la solicitud */
if (isset($_POST['id']) && isset($_POST['estado'])) {

    $params = [
        'estado' => $_POST['estado'],
        'fecha_evaluacion' => date('d/m/Y'),
        'observaciones' => $_POST['observaciones'],
        'id_usuario_admin' => UsuarioController::get(['id_wappersonas' => $_SESSION['usuario']['wapPersonasId']])['id']
    ];

    if ($_POST['estado'] === 'Aprobado') {
        $params['fecha_vencimiento'] = date('d/m/Y', strtotime('+1 year -1 day', strtotime(date('Y-m-d'))));
    }

    $sol = SolicitudController::update($params, $_POST['id']);
    echo ($sol);
    exit();
}
