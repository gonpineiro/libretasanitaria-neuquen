<?php

require_once('../app/config.php');

if (MIGRATE) {
    $conn = new ConnectMysql();
    $conn->connect();

    /* User Table */
    $usersSql =
        "CREATE TABLE `pure`.`usuarios` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(45) NULL,
                `password` VARCHAR(45) NULL,
                `number` INT NULL,
                PRIMARY KEY (`id`));";

    $conn->exec_query($usersSql);

    
} else {
    header('Location: ../');
}
