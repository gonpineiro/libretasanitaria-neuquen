<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate ");

/* Root Path */
include_once 'paths.php';

/* AutoLoad composer & local */
require ROOT_PATH . 'app/utils/funciones.php';
require ROOT_PATH . 'vendor/autoload.php';

/* Carga del DOTENV */
$dotenv = \Dotenv\Dotenv::createImmutable(ROOT_PATH);
$dotenv->load();

/* Modo produccion: true */
define('PROD', $_ENV['PROD']);

/* Seguridad para migration */
define('MIGRATE', $_ENV['MIGRATE']);

/* Configuracion base de datos */
if (PROD) {
    define('DB_HOST', $_ENV['DB_HOST']);
    define('DB_USER', $_ENV['DB_USER']);
    define('DB_PASS', $_ENV['DB_PASS']);
    define('DB_NAME', $_ENV['DB_NAME']);
    define('DB_PORT', $_ENV['DB_PORT']);
    define('DB_CHARSET', $_ENV['DB_CHARSET']);
}


if (PROD) define('WS_URL', 'http://weblogin.muninqn.gov.ar/api/getUserByToken/');
if (!PROD) define('WS_URL', 'http://muninqn.gov.ar:90/api/getUserByToken/');

if (!PROD) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'libreta');
    define('DB_PORT', '3306');
    define('DB_CHARSET', 'utf8');
}

/* Configuración de tablas */
define('USUARIOS', $_ENV['DB_USUARIOS_TABLE']);
define('CAPACITADORES', $_ENV['DB_CAPACITADORES_TABLE']);
define('SOLICITUDES', $_ENV['DB_SOLICITUDES_TABLE']);
define('LOG', $_ENV['DB_LOG_TABLE']);

/* Limit Length columns */
define('LT_USU_NOMBRE', $_ENV['LT_USU_NOMBRE']);
define('LT_USU_APELLIDO', $_ENV['LT_USU_APELLIDO']);
define('LT_USU_TELEFONO', $_ENV['LT_USU_TELEFONO']);
define('LT_USU_EMAIL', $_ENV['LT_USU_EMAIL']);
define('LT_USU_DIRRENAPER', $_ENV['LT_USU_DIRRENAPER']);

define('LT_SOL_NRORECIBO', $_ENV['LT_SOL_NRORECIBO']);
define('LT_SOL_OBS', $_ENV['LT_SOL_OBS']);

define('LT_CAP_NOMBRE', $_ENV['LT_CAP_NOMBRE']);
define('LT_CAP_APELLIDO', $_ENV['LT_CAP_APELLIDO']);
define('LT_CAP_MATRICULA', $_ENV['LT_CAP_MATRICULA']);
define('LT_CAP_LUCAPACITACION', $_ENV['LT_CAP_LUCAPACITACION']);
