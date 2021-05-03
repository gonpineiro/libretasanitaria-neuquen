<?php
include_once '../../../app/config/config.php'
?>

<body>
    <div class="body container">
        <div class="elementor-divider"> <span class="elementor-divider-separator"></span></div>
        <div class="info row mb-5" id="info">
            Mostramos el carnet
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        let targetEle = $("#msje-exito");
        animateToInput(targetEle);
    });
</script>
<?php
foreach ($_POST as $key => $val) {
    unset($_POST[$key]);
}
?>