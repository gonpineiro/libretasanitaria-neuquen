<?php
set_time_limit(1000);
error_reporting(-1);

include("../../../configuration.php");

use League\Csv\Exception;
use League\Csv\Writer;


session_start();
if ($_SESSION['userProfiles'] != 3){
    header('https://weblogin.muninqn.gov.ar');
    exit();
}

if (isset($_GET['descargar']) && $_GET['descargar'] != 3) {
    $datos = buscar(['ferias_solicitud.feria' => $_GET['descargar']]);
    
} elseif ($_GET['descargar'] == 3) {
    $datos = buscar();

}

$csv = Writer::createFromFileObject(new SplTempFileObject());

$csv->insertOne(['Fecha Solicitud',
                 'Id Solicitud',
                 'Nombre',
                 'Documento',
                 'Genero',
                 'Fecha Nac.',
                 'Mail',
                 'Celular',
                 'Domicilio',
                 'Cod. Postal',
                 'Mail Actualiz.',
                 'Celular Actualiz.',
                 'Ciudad',
                 'Feria',
                 'Nombre emprendimiento',
                 'Rubro emprendimiento',
                 'Producto',
                 'Instagram',
                 'Previa Participacion']);        
                 
                
                 
$csv->insertAll($datos);

$fechaCsv = date('d-m-Y h:i:s A');
$feria = $_GET['descargar']==1?'Emprende':($_GET['descargar']==2?'Raiz':'Todos');
$csv->output("Feria: $feria - $fechaCsv.csv");

/**
 * Permite realizar la busqueda de un objeto por multiples campos y si se especifica, con operadores
 * específicos.
 * @param array $param arreglo del direccion 'campo' => 'valor buscado' o vacio si se necesitan listar todos
 * @param array $ops arreglo opcional del direccion 'campo' => 'operador', por defecto el operador es '='
 * @return Usuario[]
 */
function buscar($param = [], $ops = [])
{
    $where = " (ferias_Solicitud.estado = 0) ";
    $values = array();
    foreach ($param as $key => $value) {
        $op = "=";
        if (isset($value)) {
            if (isset($ops[$key])) {
                $op = $ops[$key];
            }
            $where .= " AND " . $key . $op . " ?";
            $values[] = $value;
        }
    }
    $arreglo = listarSolicitudes($where, $values);  
    return $arreglo;
}

/**
 * Lista y organiza resultados relacionados a las solicitudes requeridas
 */
function listarSolicitudes($parametro = "1=1",$valor = [])
{
    $arreglo = array();
    $base = new BaseDatos();
    $sql = "SELECT  ferias_Solicitud.id AS 'Id Solicitud', ferias_Solicitud.fechaAlta AS 'Alta Solicitud', wapPersonas.Nombre, wapPersonas.Documento, wapPersonas.Genero, wapPersonas.fechaNacimiento, wapPersonas.CorreoElectronico AS Mail, 
                      wapPersonas.Celular, wapPersonas.DomicilioReal, wapPersonas.CPostalReal,  ferias_Usuario.email AS 'Mail Actualiz', ferias_Usuario.telefono AS 'Cel Actualiz', ferias_Usuario.ciudad, ferias_Solicitud.feria, 
                      ferias_Solicitud.nombre_emprendimiento AS 'Nombre Emprendimiento', ferias_Solicitud.rubro_emprendimiento AS Rubro, ferias_Solicitud.producto, 
                      ferias_Solicitud.instagram, ferias_Solicitud.previa_participacion
            FROM ferias_Solicitud 
            LEFT OUTER JOIN ferias_Usuario ON ferias_Solicitud.id_usuario = ferias_Usuario.id 
            LEFT OUTER JOIN wapPersonas ON ferias_Usuario.id_wappersonas = wapPersonas.ReferenciaID
    ";
        
    if ($parametro != "") {
        $sql .= 'WHERE ' . $parametro;
    }
    
    $query = $base->prepareQuery($sql);
    $res = $base->executeQuery($query,false, $valor);
    if ($res) {
        
        $municipios = buscarCiudades()['municipios'];
        $municipios = array_reduce($municipios,function ($carry, $item) {
            $carry[$item['id']] = $item['nombre'];
            return $carry;
        }, []);
        
        while ($row = $base->Registro($query)) {
            $row['feria'] = $row['feria'] == 1?'Emprende':'Raiz';
            $row['producto'] = $row['producto'] == 1?'Elaboracion Propia':'Reventa';
            $row['previa_participacion'] = $row['previa_participacion'] == 1?'Si':'No';
            $row['ciudad'] = $municipios[$row['ciudad']];
            $row['Alta Solicitud'] = date('d-m-Y',$row['Alta Solicitud']);
            array_push($arreglo, $row);
        }
    }
    return $arreglo;
}

function buscarCiudades() {
    $uri = "https://apis.datos.gob.ar/georef/api/municipios?provincia=58&campos=nombre&max=999";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($data, true);
    return $data;
}

?>