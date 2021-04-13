<?php
include '../config/config.php';

use App\Connections\ConnectMysql;

if (MIGRATE) {
    $conn = new ConnectMysql();
    $conn->connect();

    /* ls_usuarios */
    /* CORREGIR */
    $ls_usuarios =
        "CREATE TABLE `ls_usuarios` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_wappersonas` INT NULL,
        `dni` INT NULL,
        `genero` VARCHAR(1) NULL,
        `nombre` VARCHAR(45) NULL,
        `apellido` VARCHAR(45) NULL,
        `telefono` VARCHAR(250) NULL,
        `email` VARCHAR(250) NULL,
        `direccion_renaper` VARCHAR(250) NULL,
        `fecha_nac` VARCHAR(45) NULL,
        `empresa_cuil` VARCHAR(250) NULL,
        `empresa_nombre` VARCHAR(250) NULL,
        `fecha_alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`))";
    $conn->exec_query($ls_usuarios);

    /* ls_solicitudes */
    $ls_solicitudes =
        "CREATE TABLE `ls_solicitudes` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_usuario_solicitante`INT NULL,
        `id_usuario_solicitado` INT NULL,
        `tipo_empleo` VARCHAR(45) NULL,
        `renovacion` BOOLEAN NULL,
        `capacitacion` VARCHAR(250) NULL,
        `id_capacitador` INT NULL,
        `municipalidad_nqn` BOOLEAN NULL,
        `nro_recibo` INT,
        `path_comprobante_pago` VARCHAR(250) NULL,
        `estado` VARCHAR(45) NULL,
        `retiro_en` VARCHAR(45) NULL,
        `fecha_alta` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`))";
    $conn->exec_query($ls_solicitudes);

    /* ls_capacitadores */
    $ls_capacitadores =
        "CREATE TABLE `ls_capacitadores` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `nombre` VARCHAR(45) NULL,
        `apellido` VARCHAR(45) NULL,
        `matricula` VARCHAR(45) NULL,
        `path_certificado` VARCHAR(45) NULL,
        `lugar` VARCHAR(45) NULL,
        `fecha_alta` TIMESTAMP NULL,
        PRIMARY KEY (`id`));";
    $conn->exec_query($ls_capacitadores);

    /* ls_log */
    $ls_log =
        "CREATE TABLE `ls_log` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `id_usuario` INT NULL,
        `id_solicitud` INT NULL,
        `id_capacitador` INT NULL,
        `error` VARCHAR(45) NULL,
        `fecha_alta` TIMESTAMP NULL,
        PRIMARY KEY (`id`));";
    $conn->exec_query($ls_log);

    /* ··················································· */

    /* Relations */
    $ls_solicitudes_id_usuario_solicitado_foreign =
        "ALTER TABLE `ls_solicitudes` 
        ADD CONSTRAINT `ls_solicitudes_id_usuario_solicitado_foreign`
        FOREIGN KEY (`id_usuario_solicitado`)
        REFERENCES `ls_usuarios` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;";
    $conn->exec_query($ls_solicitudes_id_usuario_solicitado_foreign);
    
    $ls_solicitudes_id_usuario_solicitante_foreign =
        "ALTER TABLE `ls_solicitudes` 
        ADD CONSTRAINT `ls_solicitudes_id_usuario_solicitante_foreign`
        FOREIGN KEY (`id_usuario_solicitante`)
        REFERENCES `ls_usuarios` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;";
    $conn->exec_query($ls_solicitudes_id_usuario_solicitante_foreign);

    $ls_solicitudes_id_capacitador_foreign =
        "ALTER TABLE `ls_solicitudes` 
        ADD CONSTRAINT `ls_solicitudes_id_capacitador_foreign`
        FOREIGN KEY (`id_capacitador`)
        REFERENCES `ls_capacitadores` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION;";
    $conn->exec_query($ls_solicitudes_id_capacitador_foreign);
} else {
    header('Location: ../');
}
