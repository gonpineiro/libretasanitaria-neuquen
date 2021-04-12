<?php
include_once '../app/config/config.php';

$_GET['APP'] = 43;
if (isset($_GET['SESSIONKEY'])) {
    $_SESSION['app'] = $_GET['APP'];
    $_SESSION['token'] = $_GET['SESSIONKEY'];
    include "../utils/WSWebLogin.php";
    if (!isset($_SESSION['usuario'])) {
        header('https://weblogin.muninqn.gov.ar');
        exit();
    }

    foreach ($_SESSION['usuario']['apps'] as $apps) {
        if ($apps['id'] == 43 && $apps['userProfiles']) {
            $_SESSION['userProfiles'] = $apps['userProfiles'];
        }
    }
    if ($_SESSION['userProfiles'] == 3) {
        header('Location: views/menu/index.php');
        exit();
    } else {
        header('Location: views/Ferias/inscripcion.php');
        exit();
    }
}
header('Location: https://weblogin.muninqn.gov.ar');
exit();
