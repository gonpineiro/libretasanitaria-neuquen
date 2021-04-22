<?php
include '../../../app/config/config.php';

if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: https://weblogin.muninqn.gov.ar');
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
$solicitudesNuevas = $solicitudController->getSolicitudesWhereEstado('Nuevo');
$solicitudesAprobadas = $solicitudController->getSolicitudesWhereEstado('Aprobado');
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


    <title>Solicitudes por Per&iacute;odo - Libreta Sanitaria</title>
    <style>
        /* en hover cambia color la fila en las tablas */

        table.dataTable tbody tr:hover {
            background-color: #E4F8FE;
            cursor: pointer;
        }

        /* modal más ancho en pantallas 800x600 */
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 750px;
            }
        }
    </style>
</head>

<body>
    <?PHP include('../formularios/header.php'); ?>
    <div id="divUserInfo" class="container py-4" style="display: table-cell;float: right;">
        <table id="tableWidth" style="float: right; margin-right: 30px;">
            <tbody>
                <tr onclick="usrOptions.style.display='block'" onmouseleave="usrOptions.style.display='none'" style="cursor: pointer;">
                    <td>
                        <img alt="" style="width: 25px;" src="../../estilos/menu/icono-login.png">
                    </td>
                    <td style="display: inline-flex; padding: 5px;">
                        <div style="color: #109AD6;"><?php echo "$apellido $nombre"; ?></div>
                    </td>
                    <td>
                        <img alt="" src="../../estilos/menu/arrDown.jpg">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div onmouseover="this.style.display='block'" onmouseleave="this.style.display='none'" id="usrOptions" style="z-index: 999; background-color: transparent; display: none; position: absolute; margin-top: -5px; width: 307px;">
                            <div onclick="window.location.href = './index.php'" class="whiteButton" style="margin-top: 5px;">Regresar</div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="body container" style="padding-bottom: 50px;">
        <div style="min-height: 50px;">
            <h2 style="padding:30px 0px;color: #076AB3;">SOLICITUDES POR PER&Iacute;ODO</h2>
        </div>

        <div class="pb-5">
            <h5>Elegir el período para realizar la búsqueda</h5>
            <form class="pt-2" action="">
                <div class="row">
                    <div class="form-group col">
                        <label for="fecha_desde font-weight-bold">Desde </label>
                        <input type="date" id="fecha_desde" class="form-control" name="fecha_desde" required>
                        <div class="invalid-feedback">
                            <strong>
                                Por favor ingrese la fecha correctamente.
                            </strong>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="fecha_hasta font-weight-bold">Hasta </label>
                        <input type="date" id="fecha_hasta" class="form-control" name="fecha_hasta" required>
                        <div class="invalid-feedback">
                            <strong>
                                Por favor ingrese la fecha correctamente.
                            </strong>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table id="tabla_solicitudes_aprobadas" class="table tablas_solicitudes">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Retiro</th>
                        <!-- <th scope="col">Empresa</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($solicitudesAprobadas as $sol) {
                        $nombreApellido = explode(', ', $sol['nombre_te']);
                    ?>
                        <tr id=<?= $sol['id'] ?>>
                            <td class="numero_sol"><?= $sol['id'] ?></td>
                            <td class="user_dni"><?= $sol['dni_te'] ?></td>
                            <td class="user_name"><?= $nombreApellido['0'] ?></td>
                            <td class="user_surname"><?= $nombreApellido['1'] ?></td>
                            <td class="date"><?= date('d/m/Y', strtotime($sol['fecha_alta_sol'])) ?></td>
                            <td class="company">-</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
        <a href="./index.php" class="btn btn-primary">Regresar</a>


        <!-- Modal Ficha Aprobada-->
        <div class="modal" id="modalFichaAprobada" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color: #076AB3;">Ficha Libreta Sanitaria</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body modal_solicitud">
                        <div class="card card flex-row flow flex-wrap">
                            <div class="card-header border-0" style="background-color: white!important;">
                                <img id="imagen-pefil-aprobada" style="width:200px" src="" />
                            </div>
                            <div class="card-block px-2" id="card-detail-sol">
                                <h4 class="card-title"><span id="nombre-span-aprobada"></span></h4>
                                <p class="card-text" style="margin-bottom:0rem;">DNI: <span id="dni-span-aprobada"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Fecha Nacimiento: <span id="fe_nac-span-aprobada"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Domicilio: <span id="dire-span-aprobada"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Teléfono: <span id="tel-span-aprobada"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Tipo de Empleo: <span id="tipo_empleo-span-aprobada"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Es renovación: <span id="renovacion-span-aprobada"></span></p>
                                <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#comprobantePago" aria-expanded="false" aria-controls="comprobantePago">
                                    Ver Comprobante de Pago
                                </button>
                                <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#capacitacion" aria-expanded="false" aria-controls="capacitacion" id="btn-capacitacion">
                                    Ver Capacitación
                                </button>

                            </div>

                            <div class="card-block w-100 pb-3 container">
                                <div class="collapse" id="comprobantePago">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe id="comprobante-pago-span-aprobada" class="embed-responsive-item" src="about:blank"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block w-100 pb-3 container">
                                <div class="collapse" id="capacitacion">
                                    <hr>
                                    <h4 class="card-title">Capacitación</h4>
                                    <p class="card-text" style="margin-bottom:0rem;">Nombre y Apellido Capacitador: <span id="nombre-capa-span-aprobada"></span></p>
                                    <p class="card-text" style="margin-bottom:0rem;">Matrícula: <span id="matricula-span-aprobada"></span></p>
                                    <p class="card-text" style="margin-bottom:0rem;">Capacitado en Municipalidad de Neuqu&eacute;n </p>
                                    <p class="card-text" style="margin-bottom:0rem;">Lugar Capacitación: <span id="lugar-capa-span-aprobada"></span></p>
                                    <p class="card-text" style="margin-bottom:0rem;">Fecha Capacitación: <span id="fecha-capa-span-aprobada"></span></p>
                                    <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#verCertificado" aria-expanded="false" aria-controls="verCertificado">
                                        Ver Certificado
                                    </button>
                                </div>
                                <div class="collapse" id="verCertificado">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe id="certificado-capa-aprobada" class="embed-responsive-item" src="about:blank"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block w-100">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Expedida D&iacute;a</th>
                                            <th scope="col">Válida Hasta D&iacute;a</th>
                                            <th scope="col">Sellado Municipal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span id="fecha-alta-span-aprobada"></td>
                                            <td><span id="fecha-alta-mas-span-aprobada"></td>
                                            <td><span id="nro-recibo-span-aprobada"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-100"></div>
                            <div class="card-footer w-100 text-muted">
                                <p id="observaciones-span-aprobada">Observaciones</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span id="id-solicitud-aprobada" hidden></span>
                        <button type="button" class="btn btn-primary" onclick="imprimirLibreta()">Imprimir
                        </button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script src="../../js/administrar/nuevas_solicitudes.js"></script>

</html>