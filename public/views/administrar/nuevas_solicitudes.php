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

$fechaactual = date('d/m/Y');
$fechaMasUnAno = strtotime('+1 year', strtotime($fechaactual));
$fechaMasUnAno = date('d/m/Y', $fechaMasUnAno);

$certificado = true;
$foto = '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';


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

    <title>Inscripci&oacute;n Ferias</title>
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
                        <th scope="col">Estado</th>
                        <th scope="col">logo ficha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="user_dni">33333333</td>
                        <td class="user_name">Mark</td>
                        <td class="user_surname">Otto</td>
                        <td class="date">01/89/2021</td>
                        <td class="company">empresa</td>
                        <td class="state">pendiente</td>
                        <td class="printCard">Imprimir</td>
                    </tr>
                    <tr>
                        <td class="user_dni">33222211</td>
                        <td class="user_name">MIke</td>
                        <td class="user_surname">Olsen</td>
                        <td class="date">12/12/2021</td>
                        <td class="company">empresa</td>
                        <td class="state">pendiente</td>
                        <td class="printCard">Imprimir</td>
                    </tr>
                    <tr>
                        <td class="user_dni">44564333</td>
                        <td class="user_name">Lawson</td>
                        <td class="user_surname">Rawson</td>
                        <td class="date">23/07/2021</td>
                        <td class="company">empresa</td>
                        <td class="state">aprobada</td>
                        <td class="printCard">Imprimir</td>
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
                    <div class="modal-body">
                        <div class="card card flex-row flow flex-wrap">
                            <div class="card-header border-0" style="background-color: white!important;">
                                <?PHP echo '<img class="" style="width:200px" src="data:image/gif;base64,' . $foto . '" />'; ?>
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
                                    <p class="card-text" style="margin-bottom:0rem;!important">Nombre y Apellido Capacitador <?PHP echo "ho"; ?></p>
                                    <p class="card-text" style="margin-bottom:0rem;!important">Matrícula: </p>
                                    <p class="card-text" style="margin-bottom:0rem;!important">Lugar Capacitación: </p>
                                    <p class="card-text" style="margin-bottom:0rem;!important">Fecha Capacitación: </p>
                                    <p class="card-text" style="margin-bottom:0rem;!important">Fecha Alta:</p>
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
    $('.tablas_solicitudes td').click(function() {
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
            // 
        } else {
           // cancelar
        }
    }
</script>

</html>