(function () {
    'use strict';
    window.addEventListener('load', function () {
        validate();
    }, false);
})();

function validate() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', (event) => {
            let inputs = $('.form-control:invalid');
            let inputsSelectize = $('.invalid');
            $('.invalid').css({"border-color": "#b94a48"});
            $('.full').css({"border-color": "#28a745"});
            if (inputsSelectize.length != 0) {
                let targetEle = inputsSelectize.closest('.form-group');
                animateToInput(targetEle);
            } else if (inputs.length != 0) {
                let targetEle = $(`#${inputs[0].id}`).closest('.form-group');
                animateToInput(targetEle);
            } 
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }else{
                $("#submit").addClass('hideDiv');
                $("#enviando").removeClass('hideDiv');
            }
            form.classList.add('was-validated');
            bsSelectValidation();

        }, false);
    });
}

function processText(inputText) {
    var output = [];
    var json = inputText.split(' ');
    json.forEach(function (item) {
        output.push(item.replace(/\'/g, '').split(/(\d+)/).filter(Boolean));
    });
    return output;
}

$( function () {

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
        
    dibujarAsteriscos();

    $("input[type='number']").on('keydown', function (e) {
        if (e.which === 38 || e.which === 40) {
            e.preventDefault();
        }
    });
    $('input').on('keydown', function (event) {
        if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
            var $t = $(this);
            event.preventDefault();
            var char = String.fromCharCode(event.keyCode);
            $t.val(char + $t.val().slice(this.selectionEnd));
            this.setSelectionRange(1, 1);
        }
    });

    $("#form").on('change', function () {
            $('.invalid').css({"border-color": "#b94a48"});
            $('.full').css({"border-color": "#28a745"});
            validate();
            bsSelectValidation();
            var form = document.getElementsByClassName('needs-validation');
            
        } 
    );
    
    $('#capacitacion').on('change', function(e) {
        if (this.value == 1) {
            $('#div-infoCapacitacion').show(500);
            $('#div-infoCapacitacion :input').attr('required', true);
        } else {
            $('#div-infoCapacitacion').hide(500);
            $('#div-infoCapacitacion :input').attr('required', false);
        }
    });

    $('#path_certificado').on('change', function(e) {
        checkArchivo(this);
    });

    $('#path_comprobante_pago').on('change', function(e) {
        checkArchivo(this);
    });

    $('#terminosycondiciones').on('change', terminosycondicionescheck(this))
    
});

function checkArchivo(file){
    var fileSize = file.files[0].size / 1024 / 1024, // in MB 
        fileType = $(file).val().toLowerCase(), 
        fileName = $(file).val().replace(/C:\\fakepath\\/i, ''),
        regex = new RegExp("(.*?)\.(pdf|jpg|png|jpeg)$", 'i'),
        max_file_size = 10;

    if (fileSize > max_file_size) {
        $(file).val(null);
        $(file).closest(".form-group").find(".invalid-feedback").addClass("d-block");
        alert(`El tamaño del archivo max es de ${max_file_size} MB. Su archivo pesa ${~~fileSize} MB`);
        
    } else {
        //* se verifica tipo de archivo
        if ( !(regex.test(fileType)) ) {
            $(file).val(null);
            $(file).closest(".form-group").find(".invalid-feedback").addClass("d-block");
            alert('Formato de archivo no aceptado. Por favor ingrese un archivo del tipo pdf, jpg, png o jpeg.');
        } else {
            $(`#labelAdjunto-${file.id}`).html(fileName);
        }
    }
}

function mostrarInputOtro(value) {
    if (value == null || value.length == 0) {
        $('#rubro_emprendimiento_div').show(500);
        $('#rubro_emprendimiento').attr('name', 'rubro_emprendimiento');
        $('#rubro_emprendimiento').attr('required', true);
        $('#rubro_emprendimiento_select').attr('name', '');
    } else {
        $('#rubro_emprendimiento_div').hide(500);
        $('#rubro_emprendimiento').attr('name', '');
        $('#rubro_emprendimiento').attr('required', false);
        $('#rubro_emprendimiento_select').attr('name', 'rubro_emprendimiento');
    }
}

function animateToInput(targetEle){
    $('html, body').stop().animate({
        'scrollTop': targetEle.offset().top
    }, 800, 'swing');
}

function dibujarAsteriscos() {
    $("input[type='text'][required]").siblings("label").addClass("required");
    $("textarea[required]").siblings("label").addClass("required");
    $("input[type='number'][required]").siblings("label").addClass("required");
    $("input[type='date'][required]").siblings("label").addClass("required");
    $("select[required]").siblings("label").addClass("required");
    $("input[type='radio'][required]").parent().siblings("label").addClass("required");
    $("input[type='file'][required]").parent().siblings("label").addClass("required");
}

function bsSelectValidation() {
    if ($("#form").hasClass('was-validated')) {
      $(".selectpicker").each(function (i, el) {
        if ($(el).is(":invalid")) {
          $(el).closest(".form-group").find(".invalid-feedback").addClass("d-block");
        }
        else {
          $(el).closest(".form-group").find(".invalid-feedback").removeClass("d-block");
        }
      });
    }
}

function terminosycondicionescheck(elem) {
    if (elem.checked) {
        $('#submit').prop('disabled', false);
    } else {
        $('#submit').prop('disabled', true);
    }
}

/**
 * Sirve para realizar llamadas ajax GET
 * @param {string} url Url a realizar la llamada
 * @return {object} data json object
 */
function llamadaAjax(url) {
    var data = function () {
        var tmp = null;
        $.ajax({
            'async': false,
            'type': 'GET',
            'global': false,
            'dataType': 'html',
            'url': url,
            'success': function(data) {
                tmp = JSON.parse(data);
            },
            'error': function() {
                console.log(url,tmp,'Error en llamaa Ajax!');
            }
        });
        return tmp;
    }();

    return data;
}

function mostrarErrorEnAlta() {
    let targetEle = $("#form").parent();
    animateToInput(targetEle);
    $(`#alertaErrorCarga`).show(500);
}
