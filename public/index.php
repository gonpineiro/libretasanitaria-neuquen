<?php
include_once '../app/config/config.php';

if (isset($_GET['SESSIONKEY'])) {
    $_SESSION['app'] = $_GET['APP'];
    $_SESSION['token'] = $_GET['SESSIONKEY'];
    include UTIL_PATH . '/WSWebLogin.php';

    if (!isset($_SESSION['usuario']) or $_SESSION['usuario']['error'] != (null || '')) {
        header('Location: ' . WEBLOGIN);
        exit();
    }

    foreach ($_SESSION['usuario']['apps'] as $apps) {
        if ($apps['id'] == APPID && $apps['userProfiles']) {
            $_SESSION['userProfiles'] = $apps['userProfiles'];
        }
    }

    /* Entorno de prueba */
    if (!PROD) $_SESSION['userProfiles'] = 3;

    if ($_SESSION['userProfiles'] != 3) {
        header('Location: views/formularios/inscripcion.php');
        exit();
    } else {
        header('Location: views/menu/index.php');
        exit();
    }
}
header('Location: ' . WEBLOGIN);
exit();
