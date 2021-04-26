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
define('PROD', $_ENV['PROD'] == 'true' ? true : false);

/* Seguridad para migration */
define('MIGRATE', $_ENV['MIGRATE'] == 'true' ? true : false);

/* AppID */
define('APPID', PROD ? 53 : 55);

/* Configuracion de URLs */
define('WEBLOGIN', PROD ? 'https://weblogin.muninqn.gov.ar' : 'http://muninqn.gov.ar:90');

/* Configuracion base de datos */
define('DB_HOST', PROD ? $_ENV['DB_HOST'] : '128.53.15.3');
define('DB_USER',  PROD ? $_ENV['DB_USER'] : 'userturnos');
define('DB_PASS',  PROD ? $_ENV['DB_PASS'] : 'turnero16');
define('DB_NAME',  PROD ? $_ENV['DB_NAME'] : 'infoprueba');
define('DB_PORT',  PROD ? $_ENV['DB_PORT'] : '3306');
define('DB_CHARSET',  PROD ? $_ENV['DB_CHARSET'] : 'utf8');

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
