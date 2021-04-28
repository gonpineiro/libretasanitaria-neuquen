<?PHP
include '../../../app/config/config.php';

$solicitud = new SolicitudController();

if (!isset($_POST['idReferencia'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}

$idReferencia = $_POST['idReferencia'];

$datosLibreta = $solicitud->getSolicitudesWhereId($idReferencia);

echo getImageByRenaper($datosLibreta);
