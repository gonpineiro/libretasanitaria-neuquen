<?php
include 'app/config/config.php';

/* echo ROOT_PATH . '<br>';
echo VIEW_PATH . '<br>';
echo LY_PATH . '<br>';
echo APP_PATH . '<br>';
echo CON_PATH . '<br>';
echo UTIl_PATH . '<br>'; */

error_reporting(E_ALL);
ini_set('display_errors', '1');

$UserController = new UsuarioController();
{
    $_POST['id_wappersonas'] = 1;
    $_POST['dni'] = 123123;
    $_POST['genero'] = "G";
    $_POST['nombre'] = "nombre";
    $_POST['apellido'] = "apellido";
    $_POST['telefono'] = "telefono";
    $_POST['email'] = "email";
    $_POST['direccion_renaper'] = "direccion_renaper";
    $_POST['fecha_nac'] = "fecha_nac";
    $_POST['empresa_cuil'] = "empresa_cuil";
    $_POST['empresa_nombre'] = "empresa_nombre";
    $_POST['fecha_alta'] = "2021-08-21";
    $UserController->store($_POST);
    unset($_POST);
    $user = $UserController->get(1);

    $_POST['empresa_cuil'] = "UPDATE";
    $_POST['empresa_nombre'] = "UPDATE";
    $_POST['fecha_alta'] = "UPDATE";
    $_POST['nombre'] = "NOMBRE_UPDATE";
    $_POST['fecha_alta'] = "UPDATE";
    $UserController->update($_POST, 1);
    unset($_POST);
}  {
    $capacitadorController = new CapacitadorController();
    $_POST['nombre'] = "nombre";
    $_POST['apellido'] = "apellido";
    $_POST['matricula'] = "matricula";
    $_POST['path_certificado'] = "path_certificado";
    $_POST['lugar_capacitacion'] = "lugar_capacitacion";
    $_POST['fecha_capacitacion'] = "fecha_capacitacion";
    $_POST['fecha_alta'] = "fecha_alta";
    $capacitadorController->store($_POST);
    unset($_POST);
    $_POST['nombre'] = "EDIT";
    $_POST['apellido'] = "EDIT";
    $_POST['matricula'] = "EDIT";
    $_POST['path_certificado'] = "EDIT";
    $_POST['lugar_capacitacion'] = "EDIT";
    $_POST['fecha_capacitacion'] = "EDIT";
    $capacitadorController->update($_POST, 3);
    unset($_POST);
    $cap = $capacitadorController->index();
    $cap2 = $capacitadorController->get(1);
}
{
    $solicitudController = new SolicitudController();
    $_POST['id_usuario_solicitante'] = 1;
    $_POST['id_usuario_solicitado'] = 2;
    $_POST['tipo_empleo'] = 'tipo_empleo';
    $_POST['renovacion'] = 1;
    $_POST['id_capacitador'] = 1;
    $_POST['municipalidad_nqn'] = 1;
    $_POST['nro_recibo'] = 2339282;
    $_POST['path_comprobante_pago'] = "path_comprobante_pago";
    $_POST['estado'] = "estado";
    $_POST['retiro_en'] = "retiro_en";
    $_POST['fecha_emision'] = "2021/02/02";
    $_POST['fecha_vencimiento'] = "venci";
    $_POST['observaciones'] = "observaciones";
    $_POST['fecha_alta'] = "observaciones";
    $solicitudController->store($_POST);
    unset($_POST);
    $_POST['id_usuario_solicitante'] = 2;
    $_POST['id_usuario_solicitado'] = 2;
    $_POST['tipo_empleo'] = '23';
    $_POST['renovacion'] = 1;
    $_POST['id_capacitador'] = 1;
    $_POST['municipalidad_nqn'] = 1;
    $_POST['nro_recibo'] = 332;
    $_POST['path_comprobante_pago'] = "6";
    $_POST['estado'] = "asd";
    $_POST['retiro_en'] = "asd";
    $_POST['fecha_emision'] = "asd";
    $_POST['fecha_vencimiento'] = "asd";
    $_POST['observaciones'] = "observaciones2";

    $solicitudController->update($_POST, 1);
    $sol = $solicitudController->index();
}





$user = $UserController->index();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Usuarios</h3>
    <ul>
        <?php
        while ($row = odbc_fetch_array($user)) { ?>
            <li><?= $row['nombre'] ?></li>
        <?php } ?>

    </ul>
    <h3>Sol</h3>
    <ul>
        <?php
        while ($row = odbc_fetch_array($sol)) { ?>
            <li><?= $row['path_comprobante_pago'] ?></li>
        <?php } ?>
    </ul>
    <h3>Cap</h3>
    <ul>
        <?php
        while ($row = odbc_fetch_array($cap)) { ?>
            <li><?= $row['matricula'] ?></li>
        <?php } ?>
        <?php echo $cap2['nombre'] ?>
    </ul>
</body>

</html>