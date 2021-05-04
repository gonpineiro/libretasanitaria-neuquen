<?php
include_once '../../../app/config/config.php';
$solicitud = new SolicitudController();
$datosLibreta = $solicitud->getSolicitudesWhereId($userWithSolicitud['id_solicitud']);
$data = getImageByRenaper($datosLibreta, false);
$tipoEmpleo = $data['tipo_empleo'] == '1' ? "CON Manipulación Alimentos" : "SIN Manipulación Alimentos";
?>

<body>
    <div class="body container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
        <div class="info row mb-5" id="info">
            <div class="col">
                <div class="card-body mb-3">
                    <p class="text-center">
                        Su solicitud N° <?= $userWithSolicitud['id_solicitud']; ?>, fue aprobado el dia: <?= $userWithSolicitud['fecha_evaluacion'] ?>, ante cualquier duda, contactarse al email: carnetma@muninqn.gob.ar
                    </p>
                </div>

            </div>
        </div>
        <div class="row mb-5 scale carnet-text">
            <div class="col-md-6 border col-sm-12 scale" style="background-color: #FFFFFF;">
                <div class="row">
                    <img src="../../estilos/carnet/banner.jpeg" class="img-fluid mb-3">
                </div>
                <div class="row">
                    <div class="col-4">
                        <img src="<?= $data['imagen'] ?>" class="img-fluid">
                    </div>
                    <div class="col-8 mx-auto my-auto ">
                        <label class="mb-0">Apellido y Nombre:</label></br>
                        <label class="mb-0"><?= $data['nombre_te'] ?></label></br>
                        <label class="mb-0">Domicilio:</label>
                        <label class="mb-0"><?= $data['direccion_te'] ?></label></br>
                        <label class="mb-0">DNI: <?= $data['dni_te'] ?></label></br>
                        <label class="mb-0">Fecha Nacimiento: <?= date('d/m/Y', strtotime($data['fecha_nac_te'])) ?></label></br>
                        <label class="mb-0">Fecha Expedición: <?= $data['fecha_evaluacion'] ?></label></br>
                        <label class="mb-0">Fecha Vencimiento: <?= $data['fecha_vencimiento'] ?></label></br>
                    </div>
                </div>

                <div class="row mt-2">
                    <p class="mx-auto" style="font-size: 25px; margin-bottom:0">Libreta Sanitaria</p>
                </div>
            </div>

            <div class="col-md-6 border col-sm-12 scale" style="background-color:#FFFFFF">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="row">
                            <label class="mx-auto" style="font-size: 25px; margin-bottom:0">Municipalidad de Neuquén</label>
                        </div>
                        <div class="row">
                            <label class="mx-auto" style="font-size: 20px; margin-bottom:0">Provincia de Neuquén</label>
                        </div>
                        <div class="row">
                            <label class="mx-auto" style="font-size: 20px">LIBRETA SANITARIA N° <?= $data['dni_te'] ?></label>
                        </div>
                        <div class="row mt-3">
                            <div class="col-8 mx-5 my-auto">
                                <label class="mb-0" style="font-size: 18px;">Tipo Empleo: <?= $tipoEmpleo ?></label></br>
                                <label class="mb-0" style="font-size: 18px;">Recibo Nro: <?= $data['nro_recibo'] ?></label></br>
                                <label class="mb-0" style="font-size: 15px;">Observaciones:</label><br>
                                <label class="mb-0" style="font-size: 18px;"><?= $data['observaciones'] ?></label><br>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <h2 class="mx-auto" style="opacity: 50%">LIBRETA DIGITAL</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mb-5">
            <a class="btn btn-primary" href=<?= WEBLOGIN ?> id="boton-volver">Volver al Inicio</a>
        </div>
    </div>
</body>