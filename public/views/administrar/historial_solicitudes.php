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

    <!-- Tabla solicitudes por período -->
    <?php include './components/solicitudes_por_periodo.php' ?>
    <!-- Modal Ficha Solicitud por período-->
    <?php include './components/modal_solicitudes_por_periodo.php' ?>

    <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
    <a href="./index.php" class="btn btn-primary">Regresar</a>



    </div>
</body>

<script src="../../../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script src="../../../node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script src="../../js/administrar/nuevas_solicitudes.js"></script>
<script>
    $('#tabla_solicitudes_periodo').on("click", "tr", function() {
        //console.log($(this).children(":first").text());
        idFila = $(this).children(":first").text();
        $.ajax({
            url: "proceso_solicitud.php",
            type: "GET",
            data: {
                id: idFila
            },
            async: false,
            success: function(res) {
                const data = $.parseJSON(res)
                console.log(data);
                $("#id-modal-periodo").html(data.id);
                /* Nombre y apellido */
                $("#nombre-span-periodo").html(data.nombre_te);
                $("#imagen-pefil-periodo").attr("src", data.imagen);

                /* Datos principales */
                $("#dni-span-periodo").html(data.dni_te);
                $("#fe_nac-span-periodo").html(formatDate(data.fecha_nac_te));
                $("#dire-span-periodo").html(data.direccion_te);
                $("#tel-span-periodo").html(data.telefono_te);
                $("#tipo_empleo-span-periodo").html(data.tipo_empleo === '1' ? 'Con manipulación de alimentos' : 'Sin manipulación de alimentos');
                $("#renovacion-span-periodo").html(data.renovacion === '1' ? 'SI' : 'NO');

                /* fechas y numero de recibo */
                $("#fecha-alta-span-periodo").html(formatDate(data.fecha_alta_sol));
                $("#fecha-alta-mas-span-periodo").html(formatDate(data.fecha_alta_sol));
                $("#nro-recibo-span-periodo").html(data.nro_recibo);
                $("#comprobante-pago-span-periodo").attr("src", data.path_comprobante_pago);


                /* capacitación */
                if (data.nombre_capacitador == (null || "")) {
                    $("#btn-capacitacion-periodo").addClass('hideDiv');
                    $("#div-capacitacion-periodo").addClass('hideDiv');
                    $("#capacitacion-span-periodo").html('NO PRESENTA');
                } else {
                    $("#btn-capacitacion-periodo").removeClass('hideDiv');
                    $("#div-capacitacion-periodo").removeClass('hideDiv');
                    $("#capacitacion-span-periodo").html('SI PRESENTA');
                }
                $("#muni-capa-span-periodo").html(data.municipalidad_nqn === '1' ? 'SI' : 'NO');
                $("#nombre-capa-span-periodo").html(data.nombre_capacitador ? data.nombre_capacitador + ' ' + data.apellido_capacitador : '');
                $("#matricula-span-periodo").html(data.matricula);
                $("#lugar-capa-span-periodo").html(data.lugar_capacitacion);
                $("#fecha-capa-span-periodo").html(formatDate(data.fecha_capacitacion));
                $("#certificado-capa-periodo").attr("src", data.path_certificado);
                /* Mostramos el modal */
                $('#modalFichaPeriodo').modal('show');
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        });
    });
    $('#buscar').on('click', function(e) {
        e.preventDefault();
        fecha_desde = formatDate($("#fecha_desde").val())
        fecha_hasta = formatDate($("#fecha_hasta").val())

        $.ajax({
            url: "consulta_periodo.php",
            type: "POST",
            data: {
                fecha_desde: fecha_desde,
                fecha_hasta: fecha_hasta,
            },
            async: true,
            success: function(response) {
                //alert(response)
                console.log(response)
                var data = $.parseJSON(response)
                // destruyo la instancia anterior
                $('#tabla_solicitudes_periodo').DataTable().clear().destroy();
                // creo la nueva instancia
                $('#tabla_solicitudes_periodo').DataTable({
                    data: data,
                    columns: [{
                            'data': "id"
                        },
                        {
                            'data': "dni_te"
                        },
                        {
                            'data': "nombre_te"
                        },
                        {
                            'data': "fecha_evaluacion"
                        },
                        {
                            'data': "retiro_en"
                        },
                        {
                            'data': "estado"
                        }

                    ],
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

            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        });
    });
</script>

</html>