<?php
include_once '../app/config/config.php';

$_GET['APP'] = 43;
if (isset($_GET['SESSIONKEY'])) {
    $_SESSION['app'] = $_GET['APP'];
    $_SESSION['token'] = $_GET['SESSIONKEY'];
    include UTIl_PATH.'\WSWebLogin.php';
    if (!isset($_SESSION['usuario']) and $_SESSION['usuario']['error'] != null) {
        header('https://weblogin.muninqn.gov.ar');
        exit();
    }

    foreach ($_SESSION['usuario']['apps'] as $apps) {
        if ($apps['id'] == 43 && $apps['userProfiles']) {
            $_SESSION['userProfiles'] = $apps['userProfiles'];
        }
    }
    
    header('Location: views/menu/index.php');
    exit();
}
header('Location: https://weblogin.muninqn.gov.ar');
exit();
