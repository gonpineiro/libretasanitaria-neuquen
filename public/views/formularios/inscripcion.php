<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: https://weblogin.muninqn.gov.ar');
    exit();
}

$errores = [];
$id_wapusuarios = $_SESSION['usuario']['referenciaID'];
$dni = $_SESSION['usuario']['documento'];
$datosPersonales = $_SESSION['usuario']['datosPersonales'];
$direccionRenaper = $datosPersonales['domicilioReal']['direccion'].' '.$datosPersonales['domicilioReal']['codigoPostal']['ciudad'];
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
    $respuesta = [];
    $usuario = null;
    $log_controller = new LogController();
    $usuario_controller = new UsuarioController;
    $solicitud_controller = new SolicitudController;
    $usuarioArr = $usuario_controller->buscar(['id_wappersonas' => $id_wappersonas]);

    if (empty($usuarioArr)) {
        $usuario = $usuario_controller->alta(
            [
                'id_wappersonas' => $id_wappersonas,
                'telefono' =>  $celular == $_POST['telefono'] ? $celular : $_POST['telefono'],
                'email' => $email == $_POST['email'] ? $email : $_POST['email'],
                'ciudad' => $_POST['nombreCiudad'],
            ]
        );
    } else {
        if ($usuarioArr[0]->getEmail() != $_POST['email'] or $usuarioArr[0]->getCiudad() != $_POST['nombreCiudad']  or $usuarioArr[0]->getTelefono() != $_POST['telefono'] ) {
            $usuarioArr[0]->setEmail($_POST['email']);
            $usuarioArr[0]->setTelefono($_POST['telefono']);
            $usuarioArr[0]->setCiudad($_POST['nombreCiudad']);
            $usuario = $usuarioArr[0]->modificar();
        } else $usuario = $usuarioArr[0];
        
    } 
    
    if (isset($usuario) and $usuario != (null or false)) {
        $respuesta['usuario'] = $usuario;
        
        $_POST['id_usuario'] = $usuario->getId();
        $_POST['estado'] = 0;
        $params = [
            'id_usuario' => $usuario->getId(),
            'feria' => $_POST['feria'],
            'nombre_emprendimiento' => $_POST['nombre_emprendimiento'],
            'rubro_emprendimiento' => $_POST['rubro_emprendimiento'],
            'producto' => 1,
            'instagram' => $_POST['instagram'],
            'previa_participacion' => $_POST['previa_participacion'],
            'estado' => $_POST['estado']            
        ];
        $solicitud = $solicitud_controller->alta($params);
        
        if ($solicitud != (null or false) and $solicitud->getMensajeoperacion() == (null or '')) {
            $respuesta['solicitud'] = $solicitud;
            $inscripcion_exitosa = true;
            $errores = false;

            $envioMail = enviarMailApi($usuario->getEmail(), [$solicitud->getId()]);
            if (!$envioMail){
                cargarLog($respuesta['usuario']->getId(), $respuesta['solicitud']->getIdsolicitud(),'Error: envio de mail fallido');
                $errores = true;
            } elseif ($envioMail->error != (null or '')) {
                cargarLog($respuesta['usuario']->getId(), $respuesta['solicitud']->getIdsolicitud(),$envioMail['error']);
                $errores = true;
            }

        } else cargarLog($respuesta['usuario']->getId(), null,'Error para cargar la Solicitud.');$errores = true;
    } else cargarLog(null, null,'Error carga Usuario.');$errores = true;

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
        <title>Inscripci&oacute;n Ferias</title>
    </head>

    <body>
        <?php 
            include('header.php');
            if ( !$inscripcion_exitosa ) {
                isset($_GET['tipo']) && $_GET['tipo'] == 'e' && $_SESSION['userPerfiles'] == (2 || 3)? include('inscripcion_empresarial.php') : include('inscripcion_individual.php');
            } else include('inscripcion_exitosa.php'); 
        ?>
    </body>

    <script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="../../js/formularios/inscripcion.js"></script>
</html>
