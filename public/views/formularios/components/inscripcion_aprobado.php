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
                        Su libreta sanitaria se encuentra vigente con vencimiento: <?= $userWithSolicitud['fecha_vencimiento']; ?>, ante cualquier duda, contactarse al email: carnetma@muninqn.gob.ar
                    </p>
                </div>

            </div>
        </div>

        <!-- Vista de carnet digital -->
        <?php include('carnet-digital.php') ?>

        <div class="text-center mb-5">
            <a class="btn btn-primary" href=<?= WEBLOGIN ?> id="boton-volver">Volver al Inicio</a>
        </div>
    </div>
</body>