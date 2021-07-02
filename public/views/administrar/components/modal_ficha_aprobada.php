<div class="modal" id="modalFichaAprobada" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: #076AB3;">Solicitud N° <span id="id-span-aprobada"> </span><span id="estado-span-aprobada"></span> </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal_solicitud">
                <div class="card card flex-row flow flex-wrap">
                    <div class="card-header border-0" style="background-color: white!important;">
                        <img id="imagen-pefil-aprobada" style="width:200px" src="" />
                    </div>
                    <div class="card-block px-2" id="card-detail-sol">
                        <h4 class="card-title"><span id="nombre-span-aprobada"></span></h4>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-credit-card-2-front"></i> DNI: <span id="dni-span-aprobada"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-calendar-event"></i> Fecha Nacimiento: <span id="fe_nac-span-aprobada"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-cursor"></i> <span id="dire-span-aprobada"></span></p>
                        <p id="tel-usu-actualizado-aprobada" class="card-text hideDiv" style="margin-bottom:0rem;"><i class=" text-info bi bi-telephone"></i> <span id="tel-usu-span-aprobada"></span><small class="text-info"> Actualizado</small></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-telephone"></i> <span id="tel-span-aprobada"></span></p>
                        <p id="email-usu-actualizado-aprobada" class="card-text hideDiv" style="margin-bottom:0rem;"><i class=" text-info bi bi-envelope"></i> <span id="email-usu-span-aprobada"></span><small class="text-info"> Actualizado</small></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-envelope"></i> <span id="email-span-aprobada"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;">Tipo de Empleo: <span id="tipo_empleo-span-aprobada"></span><span> <a href="#" onclick="cambiarEstadoManipulacion()" style="text-decoration: none;">(Cambiar)</a></span></p>
                        <p class="card-text" style="margin-bottom:0rem;">Es renovación: <span id="renovacion-span-aprobada"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;">Capacitación: <span id="capacitacion-span-aprobada"></span></p>

                        <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#comprobantePago" aria-expanded="false" aria-controls="comprobantePago">
                            Ver Comprobante de Pago
                        </button>
                        <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#capacitacion-aprobada" aria-expanded="false" aria-controls="capacitacion-aprobada" id="btn-capacitacion-aprobada">
                            Ver Capacitación
                        </button>

                    </div>

                    <div class="card-block w-100 pb-3 container">
                        <div class="collapse" id="comprobantePago">
                            <div id="comprobante-pago-span-aprobada"></div>
                        </div>
                    </div>
                    <div id="div-capacitacion-aprobada" class="card-block w-100 pb-3 container">
                        <div id="capacitacion-aprobada" class="collapse">
                            <hr>
                            <h4 class="card-title">Capacitación</h4>
                            <p class="card-text" style="margin-bottom:0rem;">Nombre y Apellido Capacitador: <span id="nombre-capa-span-aprobada"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Capacitado en Municipalidad de Neuqu&eacute;n: <span id="muni-capa-span-aprobada"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Lugar Capacitación: <span id="lugar-capa-span-aprobada"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Fecha Capacitación: <span id="fecha-capa-span-aprobada"></span></p>
                            <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#verCertificado" aria-expanded="false" aria-controls="verCertificado">
                                Ver Certificado
                            </button>
                        </div>
                        <div class="collapse" id="verCertificado">
                            <div id="certificado-capa-aprobada"></div>
                        </div>
                    </div>
                    <div class="card-block w-100">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Expedida D&iacute;a</th>
                                    <th scope="col">Válida Hasta D&iacute;a</th>
                                    <th scope="col">Sellado Municipal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span id="fecha-alta-span-aprobada"></td>
                                    <td><span id="fecha-alta-mas-span-aprobada"></td>
                                    <td><span id="nro-recibo-span-aprobada"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100"></div>
                    <div class="card-footer w-100 text-muted">
                        <div id="observaciones-actualizacion" class="alert alert-success" style="display: none;" role="alert">
                            Se actualizaron las observaciones.
                        </div>
                        <form class="form-horizontal mx-auto">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea id="observaciones-span-aprobada" class="form-control" maxlength="50" style="border: none!important;box-shadow: inset 0 -1px 0 #ddd;" rows="3"></textarea>
                            </div>
                        </form>
                        <p>Solicitud evaluada por: <span id="evaluador-span-aprobada"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="id-solicitud-aprobada" hidden></span>
                <button type="button" class="btn btn-primary" onclick="actualizarObservaciones()">Actualizar Observaciones
                </button>
                <button type="button" class="btn btn-primary" onclick="imprimirLibreta()">Imprimir
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>