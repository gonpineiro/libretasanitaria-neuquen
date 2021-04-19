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


function prueba()
{
    echo "ho";
}
// para determinar el tipo de archivo con los certificados y con el comprobante de pago
$content = file_get_contents("https://weblogin.muninqn.gov.ar/api/Renaper/waloBackdoor/M32020923");
$result = json_decode($content);
$foto = $result->docInfo->imagen;


// si tiene certificación se visualiza el botón con el collapse para verlo en el modal
$certificado = true;







function listarSolicitudes($parametro = "1=1", $valor = [])
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
            /* where estado nuevo */
    ";

    if ($parametro != "") {
        $sql .= 'WHERE ' . $parametro;
    }

    $query = $base->prepareQuery($sql);
    $res = $base->executeQuery($query, false, $valor);
    if ($res) {

        $municipios = buscarCiudades()['municipios'];
        $municipios = array_reduce($municipios, function ($carry, $item) {
            $carry[$item['id']] = $item['nombre'];
            return $carry;
        }, []);

        while ($row = $base->Registro($query)) {
            $row['feria'] = $row['feria'] == 1 ? 'Emprende' : 'Raiz';
            $row['producto'] = $row['producto'] == 1 ? 'Elaboracion Propia' : 'Reventa';
            $row['previa_participacion'] = $row['previa_participacion'] == 1 ? 'Si' : 'No';
            $row['ciudad'] = $municipios[$row['ciudad']];
            $row['Alta Solicitud'] = date('d-m-Y', $row['Alta Solicitud']);
            array_push($arreglo, $row);
        }
    }
    return $arreglo;
}
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


    <title>Inscripci&oacute;n Ferias</title>
    <style>
        /* modal más ancho en pantallas 800x600 */
        @media (min-width: 576px) {
            .modal-dialog {
                max-width: 700px;
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
            <h2 style="padding:30px 0px;color: #076AB3;">NUEVAS SOLICITUDES</h2>
        </div>
        <div class="table-responsive">
            <table id="tabla_nuevas_solicitudes" class="table tablas_solicitudes">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Empresa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="user_dni">33333333</td>
                        <td class="user_name">Mark</td>
                        <td class="user_surname">Otto</td>
                        <td class="date">01/89/2021</td>
                        <td class="company">empresa</td>
                    </tr>
                    <tr>
                        <td class="user_dni">33222211</td>
                        <td class="user_name">MIke</td>
                        <td class="user_surname">Olsen</td>
                        <td class="date">12/12/2021</td>
                        <td class="company">empresa</td>
                    </tr>
                    <tr>
                        <td class="user_dni">44564333</td>
                        <td class="user_name">Lawson</td>
                        <td class="user_surname">Rawson</td>
                        <td class="date">23/07/2021</td>
                        <td class="company">empresa</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
        <div style="min-height: 50px;">
            <h2 style="padding:30px 0px;color: #076AB3;">SOLICITUDES APROBADAS</h2>
        </div>
        <div class="table-responsive">
            <table id="tabla_solicitudes_aprobadas" class="table tablas_solicitudes">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">
                            <div class="text-center">
                                Estado
                            </div>
                        </th>
                        <th scope="col">
                            <div class="text-center">Imprimir</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="user_dni">33333333</td>
                        <td class="user_name">Mark</td>
                        <td class="user_surname">Otto</td>
                        <td class="date">01/89/2021</td>
                        <td class="company">empresa</td>
                        <td class="state text-center text-success"><i class="bi bi-check-circle-fill"></i></td>
                        <td class="printCard text-center"><a href="libreta.php" target=_blank><i class="bi bi-printer-fill"></i></a></td>
                    </tr>
                    <tr>
                        <td class="user_dni">33222211</td>
                        <td class="user_name">MIke</td>
                        <td class="user_surname">Olsen</td>
                        <td class="date">12/12/2021</td>
                        <td class="company">empresa</td>
                        <td class="state text-center text-success"><i class="bi bi-check-circle-fill"></i></td>
                        <td class="printCard text-center"><a href="libreta.php" target=_blank><i class="bi bi-printer-fill"></i></a></td>
                    </tr>
                    <tr>
                        <td class="user_dni">44564333</td>
                        <td class="user_name">Lawson</td>
                        <td class="user_surname">Rawson</td>
                        <td class="date">23/07/2021</td>
                        <td class="company">empresa</td>
                        <td class="state text-center text-success"><i class="bi bi-check-circle-fill"></i></td>
                        <td class="printCard text-center"><a href="libreta.php" target=_blank><i class="bi bi-printer-fill"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Ficha-->
        <div class="modal" id="modalFicha" tabindex="-1" role="dialog">
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
                                <?PHP echo '<img class="" style="width:200px" src=" ' . $foto . '" />'; ?>
                            </div>
                            <div class="card-block px-2">
                                <h4 class="card-title">Nombre y Apellido</h4>
                                <p class="card-text" style="margin-bottom:0rem;">DNI:</p>
                                <p class="card-text" style="margin-bottom:0rem;">Fecha Nacimiento: </p>
                                <p class="card-text" style="margin-bottom:0rem;">Domicilio: </p>
                                <p class="card-text" style="margin-bottom:0rem;">Teléfono: </p>
                                <p class="card-text" style="margin-bottom:0rem;">Tipo de Empleo: CON/SIN MANIPULACIÓN ALIMENTOS</p>
                                <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#comprobantePago" aria-expanded="false" aria-controls="comprobantePago">
                                    Ver Comprobante de Pago
                                </button>
                                <?PHP
                                if ($certificado) {
                                    echo '<button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#capacitacion" aria-expanded="false" aria-controls="capacitacion">
                                        Ver Capacitación
                                    </button>';
                                }
                                ?>
                            </div>

                            <div class="card-block w-100 pb-3 container">
                                <div class="collapse" id="comprobantePago">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="<?PHP $comprobantePago = './2.png';
                                                                                    echo $comprobantePago ?>"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block w-100 pb-3 container">
                                <div class="collapse" id="capacitacion">
                                    <hr>
                                    <h4 class="card-title">Capacitación</h4>
                                    <p class="card-text" style="margin-bottom:0rem;">Nombre y Apellido Capacitador <?PHP echo "ho"; ?></p>
                                    <p class="card-text" style="margin-bottom:0rem;">Matrícula: </p>
                                    <p class="card-text" style="margin-bottom:0rem;">Lugar Capacitación: </p>
                                    <p class="card-text" style="margin-bottom:0rem;">Fecha Capacitación: </p>
                                    <p class="card-text" style="margin-bottom:0rem;">Fecha Alta:</p>
                                    <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#verCertificado" aria-expanded="false" aria-controls="verCertificado">
                                        Ver Certificado
                                    </button>
                                </div>
                                <div class="collapse" id="verCertificado">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="./1.pdf"></iframe>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block w-100">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Expedida Día</th>
                                            <th scope="col">Válida Hasta Día</th>
                                            <th scope="col">Sellado Municipal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?PHP echo $fechaactual ?></td>
                                            <td><?PHP echo $fechaMasUnAno ?></td>
                                            <td>257951084</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="w-100"></div>
                            <div class="card-footer w-100 text-muted">
                                <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal mx-auto needs-validation" name="form" id="form" novalidate>
                                    <div class="form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="confirmacionAprobar()">Aprobar</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" href="#modalConfirmacion" style="background-color: #f54842; border-color: #f54842;">Rechazar</button>
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
<script>
    $('#tabla_nuevas_solicitudes td').click(function() {
        //$('.modal-body').html($(this).closest('tr').html());
        $('#modalFicha').modal('show');
    });
</script>

<script>
    $(document).ready(function() {
        $('.tablas_solicitudes').DataTable({
            "language": {
                "lengthMenu": "Display _MENU_ solicitudes por página",
                "zeroRecords": "No se encuentra",
                "info": "Viendo página _PAGE_ de _PAGES_",
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
<script>
    function confirmacionAprobar() {
        if (confirm("Está seguro de aprobar la solicitud?")) {
            document.write(' <?php prueba(); ?> ');
        } else {
            // cancelar
        }
    }
</script>

</html>