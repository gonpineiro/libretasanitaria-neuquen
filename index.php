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

$UserController = new UsuarioController();
$_POST['nro_tramite'] = '25698';
$_POST['path_foto'] = "Juan Jose";
$_POST['dni'] = "Juan Jose";
$_POST['nombre'] = "Juan Jose";
$_POST['apellido'] = "Juan Jose";
$_POST['fecha_nac'] = "Juan Jose";
$_POST['genero'] = "Juan Jose";
$_POST['telefono'] = "Juan Jose";
$_POST['email'] = "Juan Jose";
$_POST['direccion_renaper'] = "Juan Jose";
$_POST['localidad'] = "Juan Jose";
$_POST['empresa_cuil'] = "Juan Jose";
$_POST['empresa_nombre'] = "Juan Jose";
$_POST['fecha_alta'] = "Juan Jose";

$UserController->store($_POST);
$user = $UserController->get(1);
unset($_POST);

$_POST['empresa_cuil'] = "UPDATE";
$_POST['empresa_nombre'] = "UPDATE";
$_POST['fecha_alta'] = "UPDATE";
$_POST['nombre'] = "NOMBRE_UPDATE";
$_POST['fecha_alta'] = "UPDATE";

$UserController->update($_POST, 3);