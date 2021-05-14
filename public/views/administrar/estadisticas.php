<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . WEBLOGIN);
    exit();
}

$errores = [];
$id_wapusuarios = $_SESSION['usuario']['referenciaID'];
$dni = $_SESSION['usuario']['documento'];
$datosPersonales = $_SESSION['usuario']['datosPersonales'];
$direccionRenaper = $datosPersonales['domicilioReal']['direccion'] . ' ' . $datosPersonales['domicilioReal']['codigoPostal']['ciudad'];
$nroTramite = $datosPersonales['properties']['renaperID'];
$id_wappersonas = $datosPersonales['referenciaID'];
$email = $_SESSION['usuario']['correoElectronico'];
$celular = $_SESSION['usuario']['celular'];
$fechanacimiento = date('d-m-Y', strtotime($_SESSION['usuario']['fechaNacimiento']));
$genero = $_SESSION['usuario']['genero'];
$nombreapellido = explode(",", $_SESSION['usuario']["razonSocial"]);
$razonSocial = $_SESSION['usuario']["razonSocial"];
$nombre = $nombreapellido[1];
$apellido = $nombreapellido[0];

$fechaactual = date('Y/m/d');
$fechaMasUnAno = strtotime('+1 year', strtotime($fechaactual));
$fechaMasUnAno = date('d/m/Y', $fechaMasUnAno);
$fechaactual = date('d/m/Y', strtotime($fechaactual));

// para determinar el tipo de archivo con los certificados y con el comprobante de pago
$content = file_get_contents("https://weblogin.muninqn.gov.ar/api/Renaper/waloBackdoor/M32020923");
$result = json_decode($content);
$foto = $result->docInfo->imagen;

// si tiene certificación se visualiza el botón con el collapse para verlo en el modal
$certificado = true;

$solicitudController = new SolicitudController();
$stats = $solicitudController->getCountEstados();

if (!isset($stats['Aprobado'])) $stats['Aprobado'] = 0;
if (!isset($stats['Rechazado'])) $stats['Rechazado'] = 0;
if (!isset($stats['Nuevo'])) $stats['Nuevo'] = 0;
$stats['total'] = $stats['Aprobado'] + $stats['Rechazado'] + $stats['Nuevo'];


$solicitudesAprobadas = [];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../node_modules/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../../estilos/estilo.css">
    <link rel="stylesheet" href="../../estilos/menu/menu.css">
    <link rel="stylesheet" type="text/css" href="../../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../node_modules/bootstrap-icons/font/bootstrap-icons.css">


    <title>Solicitudes por Per&iacute;odo - Estad&iacute;sticas</title>
    <style>

    </style>
</head>

<body>
    <?PHP include('../formularios/components/header.php'); ?>
    <tbody>
        <tr>
            <td style="padding: 35px;">
                <div class="header">
                    <div id="divUserInfo" style="display: table-cell;">
                        <table id="tableWidth" style="float: right; margin-right: 30px;">
                            <tbody>
                                <tr onclick="usrOptions.style.display='block'" onmouseleave="usrOptions.style.display='none'" style="cursor: pointer;">
                                    <td>
                                        <img alt="" style="width: 25px;" src="../../estilos/menu/icono-login.png">
                                    </td>
                                    <td style="display: inline-flex; padding: 5px;">
                                        <div style="color: #109AD6;" id="lblVarUSUARIO"><?php echo "$apellido $nombre"; ?></div>
                                    </td>
                                    <td>
                                        <img alt="" src="../../estilos/menu/arrDown.jpg">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div onmouseover="this.style.display='block'" onmouseleave="this.style.display='none'" id="usrOptions" style="z-index: 999; background-color: transparent; display: none; position: absolute; margin-top: -10px; width: 307px;">
                                            <div onclick="window.location.href = 'https://weblogin.muninqn.gov.ar'" class="whiteButton" style="margin-top: 5px;">Regresar</div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
    <div class="container pt-5">
        <span style="color: transparent;">.</span>
    </div>




    <div class="body container" style="padding-bottom: 50px;">
        <div class="row">
            <div class="col-md-3">
                <div class="card-counter primary">
                    <i class="fa fa-code-fork"></i>
                    <span class="count-numbers"><?= $stats['total'] ?></span>
                    <span class="count-name">Total Solicitudes</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter danger">
                    <i class="fa fa-ticket"></i>
                    <span class="count-numbers"><?= $stats['Rechazado'] ?></span>
                    <span class="count-name">Solicitudes Rechazadas</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter success">
                    <i class="fa fa-database"></i>
                    <span class="count-numbers"><?= $stats['Aprobado'] ?></span>
                    <span class="count-name">Solicitudes Aprobadas</span>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-counter info">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers"><?= $stats['Nuevo'] ?></span>
                    <span class="count-name">Solicitudes Nuevas</span>
                </div>
            </div>
        </div>
        <a href="./index.php" class="btn btn-primary">Regresar</a>
    </div>
</body>

<script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>


<script src="../../js/administrar/periodo_solicitudes.js"></script>

</html>