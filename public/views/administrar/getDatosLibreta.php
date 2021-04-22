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

// busca la foto dni
$genero = $datosLibreta['genero_te'];
$dni = $datosLibreta['dni_te'];

$response = file_get_contents('https://weblogin.muninqn.gov.ar/api/Renaper/waloBackdoor/' . $genero . $dni);
$json = json_decode($response);
$imagen = $json->{'docInfo'}->{'imagen'};

// si la imagen retorna NULL fuerzo su búsqueda con @F al final de la url
if (is_null($imagen)) {
    $response = file_get_contents('https://weblogin.muninqn.gov.ar/api/Renaper/waloBackdoor/' . $genero . $dni . "@F");
    $json = json_decode($response);
    $imagen = $json->{'docInfo'}->{'imagen'};
}
$datosLibreta[] = $imagen;
echo utf8_converter($datosLibreta, true);
