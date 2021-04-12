<body>
    <div class="body container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
        <div class="info row mb-5" id="info">
            <div class="col">
                <div class="alert alert-success mt-3" role="alert" id="msje-exito">
                    ¡Se ha realizado la solicitud con &eacute;xito!
                </div>
                <div class="card-body mb-3">
                    <p class="card-text text-center">Nº de Solicitud: <?php echo $respuesta['solicitud']->getId(); ?></p>
                    <br>
                    <p class="">
                    <p>Gracias por inscribirte para participar en la Feria Neuquén Emprende/Proyecto Raíz, de ser seleccionado/a nos comunicaremos via telefónica con vos para coordinar tu participación. </p>
                    </p>
                </div>
                <div class="text-center">
                    <a class="btn btn-primary" href='https://weblogin.muninqn.gov.ar' id="boton-volver">Volver al Inicio</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        let targetEle = $("#msje-exito");
        animateToInput(targetEle);
    });
</script>
<?php
foreach($_POST as $key => $val) {
    unset($_POST[$key]);
}

session_destroy();
$_SESSION = [];
unset($_COOKIE['PHPSESSID']);

?>
