<?php if (isset($errores['duplicado']) && $errores['duplicado'] != '') { ?>
    <div style='display:none' id="alertaErrorCarga" class="alert alert-danger fade show" role="alert">
        Error: <?= $errores['duplicado'];  ?>
    </div>
<?php } ?>


<?php if (isset($userNot) && $userNot != '' && count($errores) == 0) { ?>
    <div id="alertaErrorCarga" class="alert alert-warning fade show" role="alert">
        <?= $userNot  ?>
    </div>
<?php } ?>