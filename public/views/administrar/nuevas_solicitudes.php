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

//listarNuevasSolicitudes();

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
    <link rel="stylesheet" type="text/css" href="../../../node_modules/datatables.net-dt/css/jquery.dataTables.min.css">

    <title>Inscripci&oacute;n Ferias</title>
</head>

<body>
    <?PHP include('../formularios/header.php'); ?>
    <div class="body container" style="padding-bottom: 50px;">
        <div class="datos-perfil">
            <div class="card text-center rounded mb-3" style="background-color:white; margin-top: 1.5em;">
                <div id="contenedorImagen">
                    <img src='../../estilos/libreta/icono-persona.png' name="fotografia" class="fotografia card-img-top img-fluid" id="fotografia" style="margin: 20px auto; height:200px; width: 200px;">
                </div>
                <div class="card-body" style="background-color: white; color: #315891 !important;">
                    <p>
                    <h4 id="cardNombre" class="card-title mt-2"><?= "$nombre $apellido" ?></h4>
                    </p>
                    <p id="cardDni"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>Dni: </bold><?= $dni ?>
                        </small></p>
                    <p id="cardTelefono"><small>
                            <bold>Tel:</bold> <?= $celular; ?>
                        </small></p>
                    <p id="cardEmail"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>Email: </bold><?= $email ?>
                        </small></p>
                    <p id="cardFechanacimiento"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>Fecha de Nacimiento: </bold><?= $fechanacimiento ?>
                        </small></p>
                    <p id="cardGenero"><small><i class="fa fa-envelope ml-0"></i>
                            <bold>G&eacute;nero:</bold> <?= $genero ?>
                        </small></p>
                </div>
            </div>
        </div>
        <div style="min-height: 50px;">
            <h3 style="padding:30px 0px;color: #076AB3;">NUEVAS SOLICITUDES</h3>
        </div>
        <table id="tabla_nuevas_solicitudes" class="table">
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
                        <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal mx-auto needs-validation" name="form" id="form" novalidate>
                            <div class="row form">
                                <div class="col-12">
                                    <div style='display:none' id="alertaErrorCarga" class="alert alert-danger fade show" role="alert">
                                        Hubo un error al intentar cargar su solicitud, por favor intente nuevamente mas tarde.
                                    </div>
                                </div>
                            </div>
                            <div class="row form">
                                <div class="col-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">

                                                <!-- DATOS PERSONALES -->
                                                <div class="form-group row">
                                                    <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                        <label for="telefono">Apellido</label>
                                                        <input type="text" id="apellido" class="form-control" value="Apellido" name="apellido" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, escriba bien el apellido
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" id="nombre" class="form-control" value="NOmbre" name="nombre" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, escriba bien el nombre
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                        <label for="fechaNacimiento">Fecha Nacimiento</label>
                                                        <input type="text" id="fechaNacimiento" class="form-control" value="02/02/1980" name="fechaNacimiento" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, escriba bien la fecha de nacimiento
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                        <label for="dni">DNI</label>
                                                        <input type="number" id="dni" class="form-control" value="40000333" placeholder="dni" name="dni" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, escriba bien el DNI
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12 col-sd-12 col-xs-12">
                                                        <label for="domicilio">Domicilio</label>
                                                        <input type="text" id="domicilio" class="form-control" value="Domicilio...." name="domicilio" required>
                                                        <div class="invalid-feedback">
                                                            Por favor, escriba bien el domicilio
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                        <label for="nacionalidad">Nacionalidad</label>
                                                        <input type="text" id="nacionalidad" class="form-control" value="Argentino" placeholder="Argentino" name="nacionalidad" required>
                                                    </div>

                                                    <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                        <label for="estadoCivil">Estado Civil</label>
                                                        <input type="text" id="estadoCivil" class="form-control" value="Soltero" placeholder="Soltero" name="estadoCivil" required>
                                                    </div>

                                                </div>
                                                <hr>
                                                <!-- CAPACITACION -->
                                                <div class="form-group row">
                                                    <div class="form-group col-lg4 col-md-4 col-sd-12 col-xs-12">
                                                        <label for="profesion">Profesión</label>
                                                        <input type="text" id="profesion" class="form-control" value="Comerciante" placeholder="Comerciante" name="profesion" required>
                                                    </div>
                                                    <div class="form-group col-lg-4 col-md-4 col-sd-12 col-xs-12">
                                                        <label for="municipalidad_nqn" class="required">Tipo de empleo</label>
                                                        <select id="municipalidad_nqn" class="selectpicker form-control" title="Seleccionar" name='municipalidad_nqn' required>
                                                            <option value="1">Si</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Por favor seleccionar un tipo de empleo
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg4 col-md-4 col-sd-12 col-xs-12">
                                                        <label for="tipoActividad">Tipo Actividad</label>
                                                        <input type="text" id="tipoActividad" class="form-control" value="idk" placeholder="idk" name="tipoActividad" required>
                                                    </div>
                                                </div>

                                                <!-- INFO CAPACITADOR -->
                                                <div id="div-infoCapacitacion" style="display: none;">
                                                    <label>DATOS DE LA CAPACITACION</label>
                                                    <div class="form-group row">
                                                        <div class="form-group col-lg-12 col-md-12 col-sd-12 col-xs-12">
                                                            <label for="municipalidad_nqn" class="required">Fue en la Municipalidad de Neuqu&eacute;n? </label>
                                                            <select id="municipalidad_nqn" class="selectpicker form-control" title="Seleccionar" name='municipalidad_nqn' required>
                                                                <option value="1">Si</option>
                                                                <option value="0">No</option>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Por favor seleccionar un tipo de organizaci&oacute;n.
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                            <label for="nombre_capacitador">Nombre del Capacitador </label>
                                                            <input type="text" id="nombre_capacitador" class="form-control" placeholder="Indique el nombre del Capacitador" name="nombre_capacitador" required>
                                                            <div class="invalid-feedback">
                                                                <strong>
                                                                    Por favor ingrese la nombre del capacitador.
                                                                </strong>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                            <label for="apellido_capacitador">Apellido del Capacitador </label>
                                                            <input type="text" id="apellido_capacitador" class="form-control" placeholder="Indique el Apellido del Capacitador" name="apellido_capacitador" required>
                                                            <div class="invalid-feedback">
                                                                <strong>
                                                                    Por favor ingrese la apellido del capacitador.
                                                                </strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                            <label for="lugar_capacitacion" class="required">Lugar de la Capacitacion CURSO MANIPULACION DE ALIMENTOS </label>
                                                            <input type="text" id="lugar_capacitacion" class="form-control" placeholder="Indique la el lugar de la capacitacion" name="lugar_capacitacion" required>
                                                            <div class="invalid-feedback">
                                                                Por favor seleccionar un tipo de organizaci&oacute;n.
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                            <label for="fecha_capacitacion">Fecha de Capacitaci&oacute;n </label>
                                                            <input type="date" id="fecha_capacitacion" class="form-control" name="fecha_capacitacion" required>
                                                            <div class="invalid-feedback">
                                                                <strong>
                                                                    Por favor ingrese la matricula del capacitador.
                                                                </strong>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="div-path_certificado" class="required">Certificado de Capacitaci&oacute;n </label>
                                                        <div class="custom-file" id="div-path_certificado">
                                                            <input id="path_certificado" class="custom-file-input" type="file" name="path_certificado" required>
                                                            <label for="path_certificado" class="custom-file-label" id="label-path_certificado"><span style="font-size: 1rem;">Adjuntar Archivo (imagen o pdf)</span></label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese el n&uacute;mero de tel&eacute;fono de la Beneficiario 1.
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#comprobanteDePago" aria-expanded="false" aria-controls="comprobanteDePago">
                                                        Ver comprobante de pago
                                                    </button>
                                                    <div class="collapse" id="comprobanteDePago">
                                                        <div class="card card-body">
                                                            <img src="https://cdn.discordapp.com/attachments/831169402706985060/831206714899431504/WhatsApp_Image_2021-04-12_at_13.36.53.jpeg" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <table class="table text-white">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Expedida Día</th>
                                                                <th scope="col">Válida Hasta Día</th>
                                                                <th scope="col">Sellado Municipal</th>
                                                                <th scope="col">Estudios</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>10/03/2021</td>
                                                                <td>09/03/2022</td>
                                                                <td>257951084</td>
                                                                <td>Normal</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group">
                                                    <label for="observaciones">Observaciones</label>
                                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" style="background-color: #109AD6;">Aprobar</button>
                        <button type="button" class="btn btn-primary" style="background-color: #109AD6;">Rechazar</button>
                        <button type="button" class="btn btn-primary" style="background-color: #109AD6;" data-dismiss="modal">Cerrar</button>
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
        $('#tabla_nuevas_solicitudes').DataTable({
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

</html>