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
$fechanacimiento = date('d-m-Y', strtotime(mb_split('T',$_SESSION['usuario']['fechaNacimiento'])[0]));
$genero = $_SESSION['usuario']['genero'];
$nombreapellido = explode(",", $_SESSION['usuario']["razonSocial"]);
$razonSocial = $_SESSION['usuario']["razonSocial"];
$nombre = $nombreapellido[1];
$apellido = $nombreapellido[0];

//* false renderiza el formulario ./inscripcion_form.php
$inscripcion_exitosa = false;

if (isset($_POST) && !empty($_POST)) {
    if (checkFile()) {
      
    /* Cargamos usuario */
    $id_wappersonas = $_SESSION['usuario']['wapPersonasId'];
    $usuario = $usuarioController->get(['id_wappersonas' => $id_wappersonas]);
    if (!$usuario) $usuarioController->store(['id_wappersonas' => $id_wappersonas]);

    /* buscamos el usuario  */
    $usuario = $usuarioController->get(['id_wappersonas' => $id_wappersonas]);
    
    /* Si es carga empresarial y se carga a un tercero  */
     if (!$usuario) {
        if (isset($_POST['dni'], $_POST['genero'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['email'], $_POST['direccion_renaper'], $_POST['fecha_nac'])) {
            $params = [
                'dni' => $_POST['dni'],
                'genero' => $_POST['genero'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'direccion_renaper' => $_POST['direccion_renaper'],
                'fecha_nac' => $_POST['fecha_nac'],
                'empresa_cuil' => $_POST['empresa_cuil'],
                'empresa_nombre' => $_POST['empresa_nombre']
            ];
    
            $usuarioController->store($params);
            $usuario = $usuarioController->get(['dni' => $params['dni'], 'genero' => $params['genero']]);

        } else $errores [] = 'Not seteados datos usuario para cargar un tercero en carga empresarial';

    }

    /* Verificamos si cambio telefono o celular */
    if ($_POST['telefono'] !== (string)$celular || $_POST['email'] !== (string)$email) {
        $usuarioParams = [
            'telefono' =>  $_POST['telefono'],
            'email' => $_POST['email']
        ];
        $usuarioController->update($usuarioParams, $usuario['id']);
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

        $idCapacitador = $capacitadorController->store($capacitadorParams);
    }

    $idCapacitador = isset($idCapacitador) && is_numeric($idCapacitador)?$idCapacitador:null; // caso error en alta, setea id null, porque el model puede devolver un bool o undefined

    /* Guardamos la solicitud */    
    $solicitudParams = [
        'id_usuario_solicitante' => $usuario['id'],
        'id_usuario_solicitado' => $usuario['id'],
        'tipo_empleo' => $_POST['tipo_empleo'],
        'renovacion' => $_POST['renovacion'],
        'id_capacitador' => $_POST['capacitacion'] === "1" ? $idCapacitador : null,
        'nro_recibo' => $_POST['nro_recibo'],
        'path_comprobante_pago' => null,
        'estado' => 'Nuevo',
        'retiro_en' => $_POST['retiro_en'],
        'fecha_evaluacion' => null,
        'fecha_vencimiento' => null,
        'observaciones' => null,
        'id_usuario_admin' => null,
    ];
    $idSolicitud = $solicitudController->store($solicitudParams);
    if ( isset($idSolicitud) ) console_log("Id Solicitud: $idSolicitud");
    if (isset($idSolicitud) && $idSolicitud != (false or null)) {
        /* Update solicitudes with paths */
        $pathComprobantePago = getDireccionesParaAdjunto($_FILES['path_comprobante_pago'], $idSolicitud, 'comprobante_pago');
        $solicitudUpdated = $solicitudController->update(
            ['path_comprobante_pago' => $pathComprobantePago],
            $idSolicitud
        );
        if (!$solicitudUpdated) {
            $errores[] = "Solicitud nro $idSolicitud: Falla en update comprobante pago";
        }

        /* Update capacitadores with paths */
        if (isset($_POST['capacitacion']) && $_POST['capacitacion'] === "1") {
            $pathCertificado = getDireccionesParaAdjunto($_FILES['path_certificado'], $idSolicitud, 'certificado');
            $capacitadorUpdated = $capacitadorController->update(
                ['path_certificado' => $pathCertificado],
                $idSolicitud
            );
            if (!$capacitadorUpdated) {
                $errores[] = "Solicitud nro $idSolicitud: Falla en update direccion capacitador.";
            }
        }
    
        /* upload comprobante & certificado */
        if (!$solicitudUpdated || !copy($_FILES["path_comprobante_pago"]['tmp_name'], $pathComprobantePago)) {
            $errores[] = "Solicitud nº $idSolicitud: Guardado de adjunto comprobante pago fallida";
        } 
        if (isset($capacitadorUpdated) && (!$capacitadorUpdated || !copy($_FILES["path_comprobante_pago"]['tmp_name'], $pathCertificado))) {
            $errores[] = "Solicitud nº $idSolicitud: Guardado de adjunto certificado capacitacion fallida";
        } 

    } else $errores[] = 'Error en alta de solicitud';
    
    if (count($errores) > 0) {
        foreach($errores as $error) {
            console_log($error);
        }
    } else {
        /* Envio mail */
        $enviarMailResult = enviarMailApi($_POST['email'], [$idSolicitud]);
        console_log('enviar mail: '.json_encode($enviarMailResult));
        if ($enviarMailResult['error']!=null) {
            $errores[] = 'Error envio de mail:'.$enviarMailResult['error'];
            console_log($enviarMailResult['error']);
        }
        
    }

    if ( count($errores) == 0 ) $inscripcion_exitosa = true;

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