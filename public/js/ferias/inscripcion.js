const opcionesParaValidar = {terminos_y_condiciones: false, reventa: true};

(function () {
    'use strict';
    window.addEventListener('load', function () {
        validate();
    }, false);
})();

function validate() {
    if ( document.getElementById('producto').value == 2 ) {
        event.preventDefault();
        event.stopPropagation();
        return false;
    }
    
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

$(document).ready(function () {

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

    $("#form").change(function () {
            $('.invalid').css({"border-color": "#b94a48"});
            $('.full').css({"border-color": "#28a745"});
            validate();
            bsSelectValidation();
            var form = document.getElementsByClassName('needs-validation');

            if (opcionesParaValidar.terminos_y_condiciones == true && opcionesParaValidar.reventa == false) {
                $("#submit").prop("disabled", false);
            } else {
                $("#submit").prop("disabled", true);
            }
            
        } 
    );

    let localidades_rn_nqn = llamadaAjax('https://apis.datos.gob.ar/georef/api/municipios?provincia=58&campos=nombre&max=999'),
        arr_localidades = $.map(localidades_rn_nqn.municipios, function (value, key) {
            return value;
        });

    for (let value of arr_localidades) {
        $('#select-ciudad').prepend(`<option value=${value.id}>${value.nombre}</option>`)
    }

    $('#select-ciudad').selectize({
        sortField: 'text'
    });
    
    
});

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
        opcionesParaValidar.terminos_y_condiciones = true;
    } else {
        opcionesParaValidar.terminos_y_condiciones = false;
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

// no se puede realizar una inscripcion con tipo de producto 'reventa'
// aun asi desean mostrar la opcion, para que el colgado que llegue hasta aca, lo vea y no le deje inscribirse o eso me explicaron
function jsjsnopodesreventa(elem) {
    switch(elem.value) {
        case '1':
            opcionesParaValidar.reventa = false;
            $('#error-reventa').hide(500);
            break;
        case '2':
            opcionesParaValidar.reventa = true;
            $('#error-reventa').show(500);
            animateToInput($('#form'));
            break;
    }
}