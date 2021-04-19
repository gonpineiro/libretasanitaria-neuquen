<?php
include_once '../app/config/config.php';

if (isset($_GET['SESSIONKEY'])) {
    $_SESSION['app'] = $_GET['APP'];
    $_SESSION['token'] = $_GET['SESSIONKEY'];
    include UTIL_PATH . '\WSWebLogin.php';
    if (!isset($_SESSION['usuario']) or $_SESSION['usuario']['error'] != null) {
        header('Location: https://weblogin.muninqn.gov.ar');
        exit();
    }

    foreach ($_SESSION['usuario']['apps'] as $apps) {
        if ($apps['id'] == 55 && $apps['userProfiles']) {
            $_SESSION['userProfiles'] = $apps['userProfiles'];
        }
    }

    // persona con permiso 1, envia a inscripcion individual
    // si tiene permiso 2 (empresarial), puede ver el menu con iconos individual/empresarial
    // con permiso 3, puede ver un 3er icono 'Admin'
    if ($_SESSION['userProfiles'] == 1) {
        header('Location: views/formularios/inscripcion.php');
        exit();
    } elseif ($_SESSION['userProfiles'] == (2 || 3)) {
        header('Location: views/menu/index.php');
        exit();
    }

    header('Location: views/menu/index.php');
    exit();
}
header('Location: https://weblogin.muninqn.gov.ar');
exit();
