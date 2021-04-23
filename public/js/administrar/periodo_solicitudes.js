$('#tabla_solicitudes_periodo').on("click", "tr", function () {
    //console.log($(this).children(":first").text());
    idFila = $(this).children(":first").text();
    $.ajax({
        url: "proceso_solicitud.php",
        type: "GET",
        data: {
            id: idFila
        },
        async: false,
        success: function (res) {
            const data = $.parseJSON(res)
            console.log(data);
            $("#id-modal-periodo").html(data.id);
            /* Nombre y apellido */
            $("#nombre-span-periodo").html(data.nombre_te);
            $("#imagen-pefil-periodo").attr("src", data.imagen);

            /* Datos principales */
            $("#dni-span-periodo").html(data.dni_te);
            $("#fe_nac-span-periodo").html(formatDate(data.fecha_nac_te));
            $("#dire-span-periodo").html(data.direccion_te);
            $("#tel-span-periodo").html(data.telefono_te);
            $("#tipo_empleo-span-periodo").html(data.tipo_empleo === '1' ? 'Con manipulación de alimentos' : 'Sin manipulación de alimentos');
            $("#renovacion-span-periodo").html(data.renovacion === '1' ? 'SI' : 'NO');

            /* fechas y numero de recibo */
            $("#fecha-alta-span-periodo").html(formatDate(data.fecha_alta_sol));
            $("#fecha-alta-mas-span-periodo").html(formatDate(data.fecha_alta_sol));
            $("#nro-recibo-span-periodo").html(data.nro_recibo);
            $("#comprobante-pago-span-periodo").attr("src", data.path_comprobante_pago);


            /* capacitación */
            if (data.nombre_capacitador == (null || "")) {
                $("#btn-capacitacion-periodo").addClass('hideDiv');
                $("#div-capacitacion-periodo").addClass('hideDiv');
                $("#capacitacion-span-periodo").html('NO PRESENTA');
            } else {
                $("#btn-capacitacion-periodo").removeClass('hideDiv');
                $("#div-capacitacion-periodo").removeClass('hideDiv');
                $("#capacitacion-span-periodo").html('SI PRESENTA');
            }
            $("#muni-capa-span-periodo").html(data.municipalidad_nqn === '1' ? 'SI' : 'NO');
            $("#nombre-capa-span-periodo").html(data.nombre_capacitador ? data.nombre_capacitador + ' ' + data.apellido_capacitador : '');
            $("#matricula-span-periodo").html(data.matricula);
            $("#lugar-capa-span-periodo").html(data.lugar_capacitacion);
            $("#fecha-capa-span-periodo").html(formatDate(data.fecha_capacitacion));
            $("#certificado-capa-periodo").attr("src", data.path_certificado);
            /* Mostramos el modal */
            $('#modalFichaPeriodo').modal('show');
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});
$('#buscar').on('click', function (e) {
    e.preventDefault();
    fecha_desde = formatDate($("#fecha_desde").val())
    fecha_hasta = formatDate($("#fecha_hasta").val())

    $.ajax({
        url: "consulta_periodo.php",
        type: "POST",
        data: {
            fecha_desde: fecha_desde,
            fecha_hasta: fecha_hasta,
        },
        async: true,
        success: function (response) {
            //alert(response)
            console.log(response)
            var data = $.parseJSON(response)
            // destruyo la instancia anterior
            $('#tabla_solicitudes_periodo').DataTable().clear().destroy();
            // creo la nueva instancia
            $('#tabla_solicitudes_periodo').DataTable({
                data: data,
                columns: [{
                    'data': "id"
                },
                {
                    'data': "dni_te"
                },
                {
                    'data': "nombre_te"
                },
                {
                    'data': "fecha_evaluacion"
                },
                {
                    'data': "retiro_en"
                },
                {
                    'data': "estado"
                }

                ],
                "language": {
                    "lengthMenu": "Display _MENU_ solicitudes por página",
                    "zeroRecords": "No se encuentra",
                    "info": "Viendo página _PAGE_ de _PAGES_",
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});