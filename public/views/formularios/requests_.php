<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: '.WEBLOGIN);
    exit();
}

// convertir la direccion ingresada a coordenadas con https://www.mapquest.com/
if ( isset($_GET['calle']) && isset($_GET['calle']) != ('' || null) && isset($_GET['altura']) && isset($_GET['altura']) != ('' || null)
        && isset($_GET['ciudad']) && isset($_GET['ciudad']) != ('' || null) ) {
    
    $calle = urlencode($_GET['calle']);
    $altura = urlencode($_GET['altura']);
    $ciudad = urlencode($_GET['ciudad']);
    $uri = "http://www.mapquestapi.com/geocoding/v1/address?key=wIOZDBNC2033ugbOfacidYTPsZ8wnuIn&street=$calle+$altura&city=$ciudad";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    $data = curl_exec($ch);
    curl_close($ch); 

    echo $data;
    
}

// fetch map images
if ( isset($_GET['s']) && isset($_GET['z']) && isset($_GET['x']) && isset($_GET['y']) ) {
    $s = $_GET["s"];
    $z = $_GET["z"];
    $x = $_GET["x"];
    $y = $_GET["y"];

    $access_token = 'pk.eyJ1IjoibmVjcm90YW5rIiwiYSI6ImNraW9seXpidzB1Y3ozMW84Ymp1YWU5NnEifQ.WvPKALIZOMkFxJTq5Io7ww';
    $id = 'mapbox/streets-v11';

    header('Content-Type: image/png');

    $uri = "https://api.mapbox.com/styles/v1/$id/tiles/$z/$x/$y?access_token=$access_token";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 
    $data = curl_exec($ch);
    curl_close($ch); 

    echo $data;
}
