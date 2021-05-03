<?php
include 'app/config/config.php';

header('HTTP/1.1 301 Moved Permanently');
header('Location: ' . WEBLOGIN);
exit();