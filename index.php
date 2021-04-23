<?php
include 'app/config/config.php';

/* $sql = "insert into dbo.ls_capacitadores (nombre) values(N'ñ')";
$db = new BaseDatos();
$db->query($sql);
die(); */

header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . WEBLOGIN);
exit();
