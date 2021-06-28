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
            //console.log(data)
            $("#id-solicitud-periodo").html(data.id)
            $("#id-span-periodo").html(data.id);
            /* Nombre y apellido */
            $("#nombre-span-periodo").html(data.nombre_te);
            $("#imagen-pefil-periodo").attr("src", data.imagen);
            /* Estado solicitud */
            if (data.estado === "Aprobado") {
                $("#estado-span-periodo").css('color', '#60C1DE').html(data.estado);
            }
            else {
                $("#estado-span-periodo").css('color', '#f54842').html(data.estado);
            }
            $("#evaluador-span-periodo").html(data.adm_nombre);
            /* Datos principales */
            $("#dni-span-periodo").html(data.dni_te);
            $("#fe_nac-span-periodo").html(formatDate(data.fecha_nac_te));
            $("#dire-span-periodo").html(data.direccion_te);
            if ((data.telefono_te === data.usu_telefono) || data.usu_telefono == '') {
                $("#tel-span-periodo").html(data.telefono_te);
                $("#tel-usu-actualizado-periodo").addClass('hideDiv');
            }
            else {
                $("#tel-span-periodo").html(data.telefono_te);
                $("#tel-usu-actualizado-periodo").removeClass('hideDiv');
                $("#tel-usu-span-periodo").html(data.usu_telefono);
            }
            if ((data.email_te === data.usu_email) || data.usu_email == '') {
                $("#email-span-periodo").html(data.email_te);
                $("#email-usu-actualizado-periodo").addClass('hideDiv');
            }
            else {
                $("#email-span-periodo").html(data.email_te);
                $("#email-usu-actualizado-periodo").removeClass('hideDiv');
                $("#email-usu-span-periodo").html(data.usu_email);
            }
            $("#tipo_empleo-span-periodo").html(data.tipo_empleo === '1' ? 'Con manipulación de alimentos' : 'Sin manipulación de alimentos');
            $("#renovacion-span-periodo").html(data.renovacion === '1' ? 'Sí' : 'No');

            /* fechas y numero de recibo */
            $("#fecha-alta-span-periodo").html(formatDate(data.fecha_alta_sol));
            $("#fecha-alta-mas-span-periodo").html(data.fecha_vencimiento);
            $("#nro-recibo-span-periodo").html(data.nro_recibo);
            if (verTipoArchivo(data.path_comprobante_pago)) {
                $("#comprobante-pago-span-periodo").html('<a href="' + data.path_comprobante_pago + '" target="_blank"><img style="width:100%" src="' + data.path_comprobante_pago + '"></a>');
            } else {
                $("#comprobante-pago-span-periodo").html('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="' + data.path_comprobante_pago + '"></iframe></div>');
            }
            //$("#comprobante-pago-span-periodo").attr("src", data.path_comprobante_pago);

            /* observaciones */
            if (data.observaciones == (null || "")) {
                $("#observaciones-span-periodo").html("No presenta");
            }
            else {
                $("#observaciones-span-periodo").html(charsetFormat(data.observaciones));
            }

            /* mostrar botón imprimir */
            if (data.estado == "Rechazado") {
                $("#btn-imprimir-periodo").addClass('hideDiv');
            }
            else {
                $("#btn-imprimir-periodo").removeClass('hideDiv');
            }

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
            $("#lugar-capa-span-periodo").html(charsetFormat(data.lugar_capacitacion));
            $("#fecha-capa-span-periodo").html(formatDate(data.fecha_capacitacion));
            if (verTipoArchivo(data.path_certificado)) {
                $("#certificado-capa-periodo").html('<a href="' + data.path_certificado + '" target="_blank"><img style="width:100%" src="' + data.path_certificado + '"></a>');
            } else {
                $("#certificado-capa-periodo").html('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="' + data.path_certificado + '"></iframe></div>');
            }
            //$("#certificado-capa-periodo").attr("src", data.path_certificado);
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
            //console.log(response)
            var data = $.parseJSON(response)
            // destruyo la instancia anterior
            $('#tabla_solicitudes_periodo').DataTable().clear().destroy();
            // creo la nueva instancia
            $('#tabla_solicitudes_periodo').DataTable({
                "order": [[0, "desc"]],
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
                "language": tableLenguaje
            });

        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
});

function descargarCsvPeriodo() {
    fecha_desde = formatDate($("#fecha_desde").val())
    fecha_hasta = formatDate($("#fecha_hasta").val())
    $.ajax({
        url: "descarga_periodo_csv.php",
        type: "POST",
        data: {
            fecha_desde: fecha_desde,
            fecha_hasta: fecha_hasta,
        },
        async: true,
        success: function (response) {
            // Se crea un link virtual con el archivo csv que ya se ha creado en descarga_periodo_csv.php
            var downloadLink = document.createElement("a");
            var url = '../../views/administrar/csv/solicitudes.csv';
            downloadLink.href = url;
            downloadLink.download = "solicitudes.csv";
            // Y se descarga virtualmente
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
            //console.log(response)
        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

function imprimirLibreta() {
    var idReferencia = document.getElementById('id-solicitud-periodo').textContent
    //console.log(idReferencia)
    $.ajax({
        url: "getDatosLibreta.php",
        type: "POST",
        data: {
            idReferencia: idReferencia
        },
        async: false,
        success: function (response) {
            var data = $.parseJSON(response);
            //console.log(data);
            var dni = data.dni_te
            var fotodni = data.imagen;
            var nombre = data.nombre_te;
            var nombre = nombre.substring(0, 26);
            var domicilio = data.direccion_do;
            var domicilio = domicilio.substring(0, 27);
            var fechaNacimiento = formatDate(data.fecha_nac_do);
            var fechaExpedicion = data.fecha_evaluacion;
            var fechaVencimiento = data.fecha_vencimiento;
            var tipoEmpleo = data.tipo_empleo === "1" ? "CON Manipulación Alimentos" : "SIN Manipulación Alimentos";
            var observaciones = data.observaciones ? charsetFormat(data.observaciones) : "No presenta";
            var nro_recibo = data.nro_recibo;
            var observaciones = observaciones.substring(0, 50);
            imprimirPdf(fotodni, nombre, dni, domicilio, fechaNacimiento, fechaExpedicion, fechaVencimiento, tipoEmpleo, observaciones, nro_recibo);

        },
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

function imprimirPdf(fotodni, nombre, dni, domicilio, fechaNacimiento, fechaExpedicion, fechaVencimiento, tipoEmpleo, observaciones, nro_recibo) {
    // https://parall.ax/products/jspdf 

    var doc = new jsPDF("p", "mm", "a4");
    // rectángulo izquierdo de la libreta
    doc.rect(20, 20, 90, 58);
    // rectángulo derecho de la libreta
    doc.rect(110, 20, 90, 58);
    doc.setTextColor(50);
    doc.setFontSize(12);
    // referencia de la posición de los textos (posición eje horizontal, posición eje vertical)
    doc.text(50, 73, "Libreta Sanitaria");
    doc.setFontSize(7);
    doc.text(50, 38, "Apellido y Nombre:");
    doc.setFontSize(9);
    doc.text(50, 41.5, nombre);
    doc.setFontSize(7);
    doc.text(50, 45, "Domicilio:");
    doc.setFontSize(9);
    doc.text(50, 48.5, domicilio);
    doc.setFontSize(9);
    doc.text(50, 52, "DNI: " + dni);
    doc.setFontSize(9);
    doc.text(50, 56, "Fecha Nacimiento: " + fechaNacimiento);
    doc.setFontSize(9);
    doc.text(50, 60, "Fecha Expedición: " + fechaExpedicion);
    doc.setFontSize(9);
    doc.text(50, 64, "Fecha Vencimiento: " + fechaVencimiento);
    doc.setFontSize(12);
    doc.text(130, 28, "Municipalidad de Neuquén");
    doc.setFontSize(10);
    doc.text(136, 33, "Provincia de Neuquén");
    doc.setFontSize(9);
    doc.text(130, 39, "LIBRETA SANITARIA N° " + dni);
    doc.setFontSize(9);
    doc.text(120, 46, "Tipo Empleo: " + tipoEmpleo);
    doc.setFontSize(9);
    doc.text(120, 50, "Recibo Nro: " + nro_recibo);
    doc.setFontSize(7);
    doc.text(120, 54, "Observaciones:");
    doc.setFontSize(9);
    doc.text(120, 58, observaciones);
    doc.addImage(banner, "JPEG", 20.4, 20.35, 89, 12.64);
    doc.addImage(fotodni, "JPEG", 22, 35, 24, 30);
    // al abrir el pdf que se genera abre la opción de impresión del browser
    doc.autoPrint({
        variant: 'javascript'
    });
    // se genera el pdf con el nombre
    doc.save("libreta-sanitaria-" + nombre + ".pdf");
}

function verTipoArchivo(fileName) {
    var fileName, fileExtension;

    fileExtension = fileName.replace(/^.*\./, ''); // USING JAVASCRIPT REGULAR EXPRESSIONS.

    switch (fileExtension) {
        case 'png':
        case 'jpeg':
        case 'jpg':
            return true;
            break;
        case 'pdf':
            return false
            break;
    }
}

const formatDate = (input) => {
    if (input == (null || '')) return ''
    const datePart = input.match(/\d+/g)

    const year = datePart[0]
    const month = datePart[1]
    const day = datePart[2]

    return day + '/' + month + '/' + year;
}

const charsetFormat = (str) => {
    str.includes('Ã¡') && (str = str.replace('Ã¡', 'á'));
    str.includes('Ã?') && (str = str.replace('Ã?', 'Á'));
    str.includes('Ã©') && (str = str.replace('Ã©', 'é'));
    str.includes('Ã%') && (str = str.replace('Ã%', 'É'));

    str.includes("Ã?") && (str = str.replace("Ã?", 'Í'));
    str.includes('Ã³') && (str = str.replace('Ã³', 'ó'));
    str.includes('Ã"') && (str = str.replace('Ã"', 'Ó'));
    str.includes('Ãº') && (str = str.replace('Ãº', 'ú'));
    str.includes('Ãs') && (str = str.replace('Ãs', 'Ú'));
    str.includes('Ã±') && (str = str.replace('Ã±', 'ñ'));
    str.includes("Ã'") && (str = str.replace("Ã'", 'Ñ'));

    str.includes("Ã¤") && (str = str.replace("Ã¤", 'ä'));
    str.includes("Ã„") && (str = str.replace("Ã„", 'Ä'));
    str.includes("Ã«") && (str = str.replace("Ã«", 'ë'));
    str.includes("Ã<") && (str = str.replace("Ã<", 'Ë'));

    str.includes("Ã") && (str = str.replace("Ã", 'í'));
    return str;
}

const tableLenguaje = {
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
{
    var banner = "data:image/jpeg;base64,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";
}