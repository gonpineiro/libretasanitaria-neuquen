<div style="min-height: 50px;">
    <h2 style="padding:30px 0px;color: #076AB3;">SOLICITUDES APROBADAS</h2>
</div>

<div class="table-responsive">
    <table id="tabla_solicitudes_aprobadas" class="table tablas_solicitudes_aprobadas">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">DNI</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Fecha</th>
                <th scope="col">Retiro</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudesAprobadas as $sol) {
                $sol = utf8_converter($sol, false);
                $nombreApellido = explode(', ', $sol['nombre_te']);
            ?>
                <tr id=<?= $sol['id'] ?>>
                    <td class="numero_sol"><?= $sol['id'] ?></td>
                    <td class="user_dni"><?= $sol['dni_te'] ?></td>
                    <td class="user_name"><?= $nombreApellido['0'] ?></td>
                    <td class="user_surname"><?= $nombreApellido['1'] ?></td>
                    <td class="date"><?= $sol['fecha_evaluacion'] ?></td>
                    <td class="company"><?= $sol['retiro_en'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>