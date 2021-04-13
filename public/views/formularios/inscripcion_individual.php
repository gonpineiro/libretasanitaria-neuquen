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
                    <img src='../../estilos/ferias/icono-persona.png' name="fotografia" class="fotografia card-img-top img-fluid" id="fotografia" style="margin: 20px auto; height:200px; width: 200px;">
                </div>
                <div class="card-body" style="background-color: white; color: #315891 !important;">
                    <p><h4 id="cardNombre" class="card-title mt-2"><?= "$nombre $apellido"?></h4></p>
                    <p id="cardDni"><small><i class="fa fa-envelope ml-0"></i><bold>Dni: </bold><?= $dni?></small></p>
                    <p id="cardTelefono"><small><bold>Tel:</bold> <?= $celular; ?></small></p>
                    <p id="cardEmail"><small><i class="fa fa-envelope ml-0"></i><bold>Email: </bold><?= $email?></small></p>
                    <p id="cardFechanacimiento"><small><i class="fa fa-envelope ml-0"></i><bold>Fecha de Nacimiento: </bold><?= $fechanacimiento?></small></p>
                    <p id="cardGenero"><small><i class="fa fa-envelope ml-0"></i><bold>G&eacute;nero:</bold> <?= $genero?></small></p>
                </div>
            </div>
        </div>
        <div class="">
            <div class="">
                <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal mx-auto needs-validation" name="form" id="form" novalidate>
                    <div class="row form">
                        <div class="col-12 elementor-divider"> <span class="elementor-divider-separator"></span></div>
                    </div>
                    <div class="row form">
                        <div class="col-12">
                            <div style='display:none' id="alertaErrorCarga" class="alert alert-danger fade show" role="alert">
                                Hubo un error al intentar cargar su solicitud, por favor intente nuevamente mas tarde.
                            </div>
                            <h1 class="titulo float-left">Inscripci&oacute;n Individual </h1>
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
                    <div style="display: none;" id="error-reventa" class="row form">
                        <div class="col-12">
                            <div class="alert alert-danger fade show" role="alert">
                                <strong>Aviso</strong> Las inscripciones a ferias no est&aacute;n disponibles para Reventa.
                            </div>
                        </div>
                    </div>
                    <div class="row form">
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                    <label for="telefono">Actualice su numero de tel&eacute;fono </label>
                                                    <input type="number" id="telefono" class="form-control" value="<?= $celular; ?>" placeholder="Tel&eacute;fono" name="telefono" required>
                                                    <div class="invalid-feedback">
                                                        <strong>
                                                            Por favor ingrese solo numeros.
                                                        </strong>
                                                    </div>
                                            </div>
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                    <label for="email">Compruebe su direcci&oacute;n de email </label>
                                                    <input type="text" id="email" class="form-control" value="<?= $email; ?>" placeholder="Email" name="email" required>
                                                    <div class="invalid-feedback">
                                                        <strong>
                                                            Por favor ingrese el direcci&oacute;n.
                                                        </strong>
                                                    </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 menor">
                                                <label for="nombreFeria" class="required">Elegir Feria </label>
                                                <select id="nombreFeria" class="selectpicker form-control" title="Seleccionar" name='feria' required>
                                                    <option value="1">Neuqu&eacute;n Emprende</option>
                                                    <option value="2">Proyecto Ra&iacute;z</option>
                                                </select> 
                                                <div class="invalid-feedback">
                                                        Por favor seleccionar un tipo de organizaci&oacute;n.
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12 ">
                                                <label for="nombre_emprendimiento">Nombre del Emprendimiento </label>
                                                <input type="text" id="nombre_emprendimiento" class="form-control" placeholder="Indique un nombre" name="nombre_emprendimiento" required>
                                                <div class="invalid-feedback">
                                                    <strong>
                                                        Por favor ingrese un nombre para su Emprendimiento.
                                                    </strong>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                <label for="select-ciudad" class="required">Ciudad en la que vive </label>
                                                <select class="form-control" id="select-ciudad" name="nombreCiudad" placeholder="Seleccione una ciudad" required>
                                                    <option value="">Ingrese una ciudad...</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    Por favor seleccione una ciudad.
                                                </div>                                                    
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                    <label for="rubro_emprendimiento" class="required">Rubro </label>
                                                    <select id="rubro_emprendimiento_select" onchange="mostrarInputOtro(this.value)" name="rubro_emprendimiento" class="selectpicker form-control" title="Seleccionar" required>
                                                        <option value="Textil">Textil</option>
                                                        <option value="Indumentaria">Indumentaria</option>
                                                        <option value="Accesorios">Accesorios</option>
                                                        <option value="Artesanas">Artesan&iacute;as</option>
                                                        <option value="Marroquineria">Marroquiner&iacute;a</option>
                                                        <option value="Madera">Madera</option>
                                                        <option value="Decoracion">Decoraci&oacute;n</option>
                                                        <option value="Ceramica">Cer&aacute;mica</option>
                                                        <option value="Cosmetica natural">Cosm&eacute;tica natural</option>
                                                        <option value="Plantas">Plantas</option>
                                                        <option value="Encuadernacion">Encuadernaci&oacute;n</option>
                                                        <option value="Tejidos">Tejidos</option>
                                                        <option value="Pinturas">Pinturas</option>
                                                        <option value="Bijouterie">Bijouterie</option>
                                                        <option value="Gastronomia">Gastronom&iacute;a</option>
                                                        <option value="Otro">Otro</option>
                                                    </select> 
                                                    <div class="invalid-feedback">
                                                        <strong>
                                                            Por favor ingrese un rubro.
                                                        </strong>
                                                    </div>
                                            </div>

                                            <div class="form-group col-lg-6 col-md-6 col-sd-12 col-xs-12">
                                                <label for="producto" class="required">Elegir tipo de producto </label>
                                                <select id="producto" class="selectpicker form-control" title="Seleccionar" name='producto' onchange="jsjsnopodesreventa(this)" required>
                                                    <option value="1">Elaboraci&oacute;n propia</option>
                                                    <option value="2">Reventa <b>(Opcion no disponible)</b></option>
                                                </select> 
                                                <div class="invalid-feedback">
                                                        Ingrese un tipo de producto, reventa no esta disponible.
                                                </div>
                                            </div>
                                        </div>

                                        <div id="rubro_emprendimiento_div" style="display: none;" class="form-group">
                                                <label for="rubro_emprendimiento">Especifique un rubro </label>
                                                <input type="text" id="rubro_emprendimiento" class="form-control" placeholder="Indique su rubro" required>
                                                <div class="invalid-feedback">
                                                    <strong>
                                                        Por favor ingrese su perfil/url de instagram.
                                                    </strong>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                                <label for="igEmprendimiento">Perfil de Instagram ligado a su emprendimiento </label>
                                                <input type="text" id="igEmprendimiento" class="form-control" placeholder="Ingrese un url o nombre de usuario v&aacute;lido" name="instagram">
                                                <div class="invalid-feedback">
                                                    <strong>
                                                        Por favor ingrese su perfil/url de instagram.
                                                    </strong>
                                                </div>
                                        </div>

                                        <div class="form-group menor">
                                            <label for="previaParticipacion" class="required">¿Alguna vez participaste en una feria? </label>
                                            <select id="previaParticipacion" class="selectpicker form-control" title="Seleccionar" name='previa_participacion' required>
                                                <option value="1">Si</option>
                                                <option value="2">No</option>
                                            </select> 
                                            <div class="invalid-feedback">
                                                    Por favor seleccionar un tipo de producto.
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
                                <span >
                                    Cualquier duda o consulta pod&eacute;s enviarnos un email a: <a href="mailto:emprende.capacitacionyempleo@gmail.com" target="_blank">emprende.capacitacionyempleo@gmail.com</a>
                                </span>
                            </div>
                            <input class="btn btn-primary mt-3 mb-3" type="submit" id="submit" value="Registrar datos" disabled />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
        
        
</body>