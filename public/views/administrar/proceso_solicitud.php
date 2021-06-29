<?php
include '../../../app/config/config.php';
$solicitudController = new SolicitudController();

/* Consultamos para el modal */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $solicitud = $solicitudController->getSolicitudesWhereId($id);
    echo getImageByRenaper($solicitud);
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

    if ($_POST['estado'] === 'Rechazado') {
        $solicitud = $solicitudController->getSolicitudesWhereId($_POST['id']);
        // Comparo las cuentas de email del registro y la actualizada. Si hay email actualizado, también se envía la notificación.
        if(!$solicitud['usu_email'] == "" AND !empty($solicitud['usu_email'])){
            // Función para enviar el email rechazado
            enviarMailRechazado($solicitud['usu_email'], $solicitud['nombre_te'], $_POST['observaciones'], $_POST['id']);
        }
        // Función para enviar el email rechazado
        enviarMailRechazado($solicitud['email_te'], $solicitud['nombre_te'], $_POST['observaciones'], $_POST['id']);
        $params['nro_recibo'] = null;
    }

    $sol = SolicitudController::update($params, $_POST['id']);
    echo ($sol);
    exit();
}

