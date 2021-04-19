<?php
include 'app/config/config.php';

if (PROD) {
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: https://weblogin.muninqn.gov.ar');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>Usuarios</h3>
    <ul>
        <?php
        while ($row = odbc_fetch_array($join)) { ?>
            <h4><?= $row['id'] ?> solicitaDO/solicitanTE</h4>
            <li><?= $row['dni_do'] ?></li>
            <li><?= $row['nombre_do'] ?></li>
            <li><?= $row['email_do'] ?></li>
            <hr>
            <li><?= $row['dni_te'] ?></li>
            <li><?= $row['nombre_te'] ?></li>
            <li><?= $row['email_te'] ?></li>
            <hr>
        <?php } ?>

    </ul>
    <h3>Sol</h3>
    <ul>
        <?php
        while ($row = odbc_fetch_array($sol)) { ?>
            <li><?= $row['path_comprobante_pago'] ?></li>
        <?php } ?>
    </ul>
    <h3>Cap</h3>
    <ul>
        <?php
        while ($row = odbc_fetch_array($cap)) { ?>
            <li><?= $row['matricula'] ?></li>
        <?php } ?>
        <?php echo $cap2['nombre'] ?>
    </ul>
</body>

</html>