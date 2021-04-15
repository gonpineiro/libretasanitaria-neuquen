<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: https://weblogin.muninqn.gov.ar');
    exit();
}
$usuarioController = new UsuarioController();
$capacitadorController = new CapacitadorController();
$solicitudController = new SolicitudController();

$estados = $solicitudController->index(['estado' => '0']);

$errores = [];
$id_wapusuarios = $_SESSION['usuario']['referenciaID'];
$dni = $_SESSION['usuario']['documento'];
$datosPersonales = $_SESSION['usuario']['datosPersonales'];
$direccionRenaper = $datosPersonales['domicilioReal']['direccion'] . ' ' . $datosPersonales['domicilioReal']['codigoPostal']['ciudad'];
$nroTramite = $datosPersonales['properties']['renaperID'];
$id_wappersonas = $datosPersonales['referenciaID'];
$email = $_SESSION['usuario']['correoElectronico'];
$celular = $_SESSION['usuario']['celular'];
$fechanacimiento = date('d-m-Y', strtotime($_SESSION['usuario']['fechaNacimiento']));
$genero = $_SESSION['usuario']['genero'];
$nombreapellido = explode(",", $_SESSION['usuario']["razonSocial"]);
$razonSocial = $_SESSION['usuario']["razonSocial"];
$nombre = $nombreapellido[1];
$apellido = $nombreapellido[0];

//* false renderiza el formulario ./inscripcion_form.php
$inscripcion_exitosa = false;

if (isset($_POST) && !empty($_POST)) {
    /* Si no existe el usuario lo guardamos en ls_usuarios */
    $id_wappersonas = $_SESSION['usuario']['wapPersonasId'];
    $usuario = $usuarioController->get(['id_wappersonas' => $id_wappersonas]);
    if (!$usuario) $usuarioController->store(['id_wappersonas' => $id_wappersonas]);

    /* buscamos el usuario  */
    $usuarioArr = $usuarioController->get(['id_wappersonas' => $id_wappersonas]);

    /* Verificamos si cambio telefono o celular */
    if ($_POST['telefono'] !== (string)$celular || $_POST['email'] !== (string)$email) {
        $usuarioParams = [
            'telefono' =>  $_POST['telefono'],
            'email' => $_POST['email']
        ];
        $usuarioController->update($usuarioParams, $usuarioArr['id']);
    }

    /* Si tiene un capacitador, primero lo guardamos */
    if (isset($_POST['capacitacion']) && $_POST['capacitacion'] === "1") {
        $capacitadorParams = [
            'nombre_capacitador' => $_POST['nombre_capacitador'],
            'apellido_capacitador' => $_POST['apellido_capacitador'],
            'matricula' => null,
            'municipalidad_nqn' => (int) $_POST['municipalidad_nqn'],
            'path_certificado' => null,
            'lugar_capacitador' => $_POST['lugar_capacitacion'],
            'fecha_capacitacion' => $_POST['fecha_capacitacion'],
        ];

        (int) $lastCapacitador = $capacitadorController->store($capacitadorParams);
    }

    /* Guardamos la solicitud */
    $solicitudParams = [
        'id_usuario_solicitante' => (int) $usuarioArr['id'],
        'id_usuario_solicitado' => (int) $usuarioArr['id'],
        'tipo_empleo' => (int) $_POST['tipo_empleo'],
        'renovacion' => (int) $_POST['renovacion'],
        'id_capacitador' => $_POST['capacitacion'] === "1" ? $lastCapacitador : null,        
        'nro_recibo' => $_POST['nro_recibo'],
        'path_comprobante_pago' => '',
        'estado' => 'Nuevo',
        'retiro_en' => $_POST['retiro_en'],
        'fecha_emision' => '',
        'fecha_vencimiento' => '',
        'observaciones' => '',
    ];
    (int) $lastSolicitud = $solicitudController->store($solicitudParams);


    /* Update solicitudes with paths */
    $pathComprobantePago = getDireccionesParaAdjunto($_FILES['path_comprobante_pago'], $lastSolicitud, 'path_comprobante_pago');
    $solicitudController->update(
        ['path_comprobante_pago' => $pathComprobantePago],
        $lastSolicitud
    );
    /* Update capacitadores with paths */
    if (isset($_POST['capacitacion']) && $_POST['capacitacion'] === "1") {
        $pathCertificado = getDireccionesParaAdjunto($_FILES['path_certificado'], $lastCapacitador, 'path_certificado');
        $capacitadorController->update(
            ['path_certificado' => $pathCertificado],
            $lastCapacitador
        );
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <title>Inscripci&oacute;n Libreta Sanitaria</title>
</head>

<body>
    <?php
    include('header.php');
    if (!$inscripcion_exitosa) {
        isset($_GET['tipo']) && $_GET['tipo'] == 'e' && $_SESSION['userPerfiles'] == (2 || 3) ? include('inscripcion_empresarial.php') : include('inscripcion_individual.php');
    } else include('inscripcion_exitosa.php');
    ?>
</body>

<script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../../js/formularios/inscripcion.js"></script>

</html>