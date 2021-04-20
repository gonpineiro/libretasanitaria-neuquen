<?php

if ($errores) {
    echo "<script>window.addEventListener('load', function () {mostrarErrorEnAlta();});</script>";
}

?>

<body>
    <div class="body container" style="margin-bottom: 5em;">
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
        <div class="">
            <div class="">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal mx-auto needs-validation" name="form" id="form" novalidate>
                    <div class="row form">
                        <div class="col-12 elementor-divider"> <span class="elementor-divider-separator"></span></div>
                    </div>
                    <div class="row form">
                        <div class="col-12">
                            <div style='display:none' id="alertaErrorCarga" class="alert alert-danger fade show" role="alert">
                                Hubo un error al intentar cargar su solicitud, por favor intente nuevamente mas tarde.
                            </div>
                            <h1 class="titulo float-left">Solicitud Individual </h1>
                        </div>
                    </div>

                    <div class="row form" hidden>
                        <label id="lblDNI"><?= $dni; ?></label>
                        <label id="lblDireccionRenaper"><?= $direccionRenaper; ?></label>
                        <label id="lblNroTramite"><?= $nroTramite; ?></label>
                        <label id="lblEmail"><?= $email; ?></label>
                        <label id="lblCelular"><?= $celular; ?></label>
                        <label id="lblFechaNac"><?= $celular; ?></label>
                        <label id="lblGenero"><?= $genero; ?></label>
                        <label id="lblRazonSocial"><?= $razonSocial; ?></label>
                        <label id="lblApellido"><?= $apellido; ?></label>
                        <label id="lblNombre"><?= $nombre; ?></label>
                    </div>
                    <div class="row form">
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">

                                        <!-- DATOS PERSONALES -->
                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                <label for="telefono">Actualice su numero de tel&eacute;fono </label>
                                                <input type="number" id="telefono" class="form-control" value="<?= $celular; ?>" placeholder="Tel&eacute;fono" name="telefono" required pattern="/^[0-9]$/">
                                                <div class="invalid-feedback">
                                                    <strong>
                                                        Por favor ingrese solo numeros.
                                                    </strong>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                <label for="email">Compruebe su direcci&oacute;n de email </label>
                                                <input type="email" id="email" class="form-control" value="<?= $email; ?>" placeholder="Email" name="email" required>
                                                <div class="invalid-feedback">
                                                    <strong>
                                                        Por favor ingrese el direcci&oacute;n.
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>

                                        <!--  -->
                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 menor">
                                                <label for="tipo_empleo" class="required">Elegir Tipo de Empleo </label>
                                                <select id="tipo_empleo" class="selectpicker form-control" title="Seleccionar" name='tipo_empleo' required>
                                                    <option value="1">Con Manipulaci&oacute;n de Alimentos</option>
                                                    <option value="0">Sin Manipulaci&oacute;n de Alimentos</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Por favor seleccionar un tipo de organizaci&oacute;n.
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 menor">
                                                <label for="renovacion" class="required">Es renovacion? </label>
                                                <select id="renovacion" class="selectpicker form-control" title="Seleccionar" name='renovacion' required>
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Por favor seleccionar un tipo de organizaci&oacute;n.
                                                </div>
                                            </div>

                                        </div>

                                        <!-- CAPACITACION -->
                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                <label for="capacitacion" class="required">Recibi&oacute; Capacitaci&oacute;n? </label>
                                                <select id="capacitacion" class="selectpicker form-control" title="Seleccionar" name='capacitacion' required>
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Por favor seleccionar un tipo de organizaci&oacute;n.
                                                </div>
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
                                                    <input type="text" id="nombre_capacitador" size="50" class="form-control" placeholder="Indique el nombre del Capacitador" name="nombre_capacitador" required>
                                                    <div class="invalid-feedback">
                                                        <strong>
                                                            Por favor ingrese la nombre del capacitador.
                                                        </strong>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                    <label for="apellido_capacitador">Apellido del Capacitador </label>
                                                    <input type="text" id="apellido_capacitador" size="50" class="form-control" placeholder="Indique el Apellido del Capacitador" name="apellido_capacitador" required>
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
                                            <label for="nro_recibo">Nro. de comprobante sellado </label>
                                            <input type="text" id="nro_recibo" size="50" class="form-control" placeholder="Ej: Recibo Nro. 0002-57972906" name="nro_recibo" required>
                                            <div class="invalid-feedback">
                                                <strong>
                                                    Por favor ingrese el numero de comprobante sellado.
                                                </strong>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="div-path_comprobante_pago" class="required">Comprobante de pago </label>
                                            <div class="custom-file" id="div-path_comprobante_pago">
                                                <input id="path_comprobante_pago" class="custom-file-input" type="file" name="path_comprobante_pago" required>
                                                <label for="path_comprobante_pago" class="custom-file-label" id="label-path_comprobante_pago"><span style="font-size: 1rem;">Adjuntar Archivo (imagen o pdf)</span></label>
                                            </div>
                                            <div class="invalid-feedback">
                                                Por favor ingrese el comprobante de pago.
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="retiro_en" class="required">Elegir Lugar de retiro del Carnet </label>
                                            <select id="retiro_en" class="selectpicker form-control" title="Seleccionar" name='retiro_en' required>
                                                <option value="Oeste">Oeste - Novella y Godoy</option>
                                                <option value="Centro">Centro - Islas Malvinas 1850</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Por favor seleccionar lugar de retiro para el carnet.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <div class="form-inline">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="terminosycondiciones" id="terminosycondiciones" onchange="terminosycondicionescheck(this);" required>
                                    <label class="form-check-label" for="terminosycondiciones">
                                        He le&iacute;do y acepto las <a class="ml-1" href="BASES_Y_CONDICIONES.pdf" target="_blank"> Bases y condiciones </a>
                                    </label>
                                </div>


                                <div class="invalid-feedback" style="color: #dc3545;">
                                    <strong>
                                        Debe aceptar los t&eacute;rminos.
                                    </strong>
                                </div>
                            </div>
                            <div class="form-inline">
                                <span>
                                    Cualquier duda o consulta pod&eacute;s enviarnos un email a: <a href="mailto:carnetma@muninqn.gob.ar" target="_blank">carnetma@muninqn.gob.ar</a>
                                </span>
                            </div>
                            <input class="btn btn-primary mt-3 mb-3" type="submit" id="submit" value="Registrar datos" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


</body>