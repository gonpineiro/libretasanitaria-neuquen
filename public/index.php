<?php
include_once '../app/config/config.php';

use App\Controllers\UsuarioController;

$_GET['APP'] = 43;
if (isset($_GET['SESSIONKEY'])) {
    $_SESSION['app'] = $_GET['APP'];
    $_SESSION['token'] = $_GET['SESSIONKEY'];
    include UTIL_PATH . '\WSWebLogin.php';
    if (!isset($_SESSION['usuario']) and $_SESSION['usuario']['error'] != null) {
        header('https://weblogin.muninqn.gov.ar');
        exit();
    }

    foreach ($_SESSION['usuario']['apps'] as $apps) {
        if ($apps['id'] == 43 && $apps['userProfiles']) {
            $_SESSION['userProfiles'] = $apps['userProfiles'];
        }
    }

    /* Si no existe el usuario lo guardamos en ls_usuarios */
    $id_wappersonas = $_SESSION['usuario']['wapPersonasId'];
    $userController = new UsuarioController();
    $usuario = $userController->get(['id_wappersonas' => $id_wappersonas]);
    if (!$usuario) $userController->store(['id_wappersonas' => $id_wappersonas]);


    // persona con permiso 1, envia a inscripcion individual
    // si tiene permiso 2 (empresarial), puede ver el menu con iconos individual/empresarial
    // con permiso 3, puede ver un 3er icono 'Admin'
    if ($_SESSION['userPerfiles'] == 1) {
        header('Location: views/formularios/inscripcion.php');
        exit();
    } elseif ($_SESSION['userPerfiles'] == (2 || 3)) {
        header('Location: views/menu/index.php');
        exit();
    }

    header('Location: views/menu/index.php');
    exit();
}
header('Location: https://weblogin.muninqn.gov.ar');
exit();
