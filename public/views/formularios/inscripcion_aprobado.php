<?php
include_once '../../../app/config/config.php'
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
                <div class="text-center">
                    <a class="btn btn-primary" href=<?= WEBLOGIN ?> id="boton-volver">Volver al Inicio</a>
                    <a class="btn btn-primary" style="background-color: #315891; border-color: #315891;" href='#' id="boton-volver">Ver Carnet</a>
                </div>
            </div>
        </div>
    </div>
</body>