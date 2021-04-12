<?php
include 'app/config/config.php';

/* echo ROOT_PATH . '<br>';
echo VIEW_PATH . '<br>';
echo LY_PATH . '<br>';
echo APP_PATH . '<br>';
echo CON_PATH . '<br>';
echo UTIl_PATH . '<br>'; */


use App\Controllers\UsuarioController;

$UserController = new UsuarioController();
$_POST['id'] = '1'; 
$_POST['nro_tramite'] = '25698'; 
$_POST['nombre'] = "Juan Jose"; 

$UserController->store($_POST);
