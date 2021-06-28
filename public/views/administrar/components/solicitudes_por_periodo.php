<div style="min-height: 50px;">
    <h2 style="padding:30px 0px;color: #076AB3;">SOLICITUDES POR PER&Iacute;ODO</h2>
</div>

<div class="pb-5">
    <h5>Elegir el período para realizar la búsqueda</h5>
    <form class="pt-2" action="">
        <div class="row">
            <div class="form-group col">
                <label for="fecha_desde font-weight-bold">Desde </label>
                <input type="date" id="fecha_desde" class="form-control" name="fecha_desde" required>
                <div class="invalid-feedback">
                    <strong>
                        Por favor ingrese la fecha correctamente.
                    </strong>
                </div>
            </div>
            <div class="form-group col">
                <label for="fecha_hasta font-weight-bold">Hasta </label>
                <input type="date" id="fecha_hasta" class="form-control" name="fecha_hasta" required>
                <div class="invalid-feedback">
                    <strong>
                        Por favor ingrese la fecha correctamente.
                    </strong>
                </div>
            </div>
            <div class="form-group col">
                <label for="fecha_hasta font-weight-bold" style="visibility: hidden;">Buscar </label>
                <input type="submit" value="Buscar Período" id="buscar" class="form-control" name="buscar" required style="background-color: #60C1DE;color:white;">
            </div>
            <div class="form-group col">
                <label for="fecha_hasta font-weight-bold" style="visibility: hidden;">Descargar .CSV </label>
                <a id="descargar_csv" href="#" onclick="descargarCsvPeriodo()" class="form-control btn" style="background-color: #60C1DE;color:white;">Descargar Período .CSV</a>
            </div>
        </div>
    </form>
</div>
<div class="table-responsive">
    <table id="tabla_solicitudes_periodo" class="table tablas_solicitudes">
        <thead class="thead-dark">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">DNI</th>
                <th scope="col">Apellido y Nombre</th>
                <th scope="col">Fecha Evaluación</th>
                <th scope="col">Retiro</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>