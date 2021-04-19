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

if (!PROD) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'libreta');
    define('DB_PORT', '3306');
    define('DB_CHARSET', 'utf8');
}

/* Configuración de tablas */
define('USUARIOS', 'ls_usuarios');
define('CAPACITADORES', 'ls_capacitadores');
define('SOLICITUDES', 'ls_solicitudes');
define('LOG', 'ls_log');
