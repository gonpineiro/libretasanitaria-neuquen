<?php
session_status() === PHP_SESSION_ACTIVE ?: session_start();

header('Content-Type: text/html; charset=utf-8');
header("Cache-Control: no-cache, must-revalidate ");

/* Root Path */
include_once 'paths.php';

/* AutoLoad composer & local */
require ROOT_PATH . 'app/utils/funciones.php';
require ROOT_PATH . 'vendor/autoload.php';

/* Modo produccion: true */
define('PROD', false);

/* Seguridad para migration */
define('MIGRATE', true);

/* Configuracion base de datos */
if (PROD) {
    define('DB_HOST', 'db_prod_host');
    define('DB_USER', 'db_prod_user');
    define('DB_PASS', 'db_prod_pass');
    define('DB_NAME', 'db_prod_name');
    define('DB_PORT', 'db_prod_port');
}

if (!PROD) {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_NAME', 'libreta');
    define('DB_PORT', '3306');
}
