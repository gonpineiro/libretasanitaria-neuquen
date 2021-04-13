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

use App\Controllers\UsuarioController;
use App\Controllers\SolicitudController;

$UserController = new UsuarioController();
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
$_POST['fecha_alta'] = "fecha_alta";

$UserController->store($_POST);
$user = $UserController->get(1);
unset($_POST);

$_POST['empresa_cuil'] = "UPDATE";
$_POST['empresa_nombre'] = "UPDATE";
$_POST['fecha_alta'] = "UPDATE";
$_POST['nombre'] = "NOMBRE_UPDATE";
$_POST['fecha_alta'] = "UPDATE";

$UserController->update($_POST, 18);


unset($_POST);
$solicitudController = new SolicitudController(); 
$_POST['id_usuario_solicitante'] = '1';
$_POST['id_usuario_solicitado'] = '2';
$_POST['tipo_empleo'] = 'tipo_empleo';
$_POST['renovacion'] = 'true';
$_POST['capacitacion'] = "capacitacion";
$_POST['id_capacitador'] = '5';
$_POST['municipalidad_nqn'] = 'true';
$_POST['nro_recibo'] = '2339282';
$_POST['path_comprobante_pago'] = "path_comprobante_pago";
$_POST['estado'] = "estado";
$_POST['retiro_en'] = "retiro_en";
$_POST['fecha_alta'] = "fecha_alta";

$solicitudController->store($_POST);

