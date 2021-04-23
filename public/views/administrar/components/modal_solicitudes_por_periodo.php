    <!-- Modal Ficha -->
    <div class="modal" id="modalFichaPeriodo" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color: #076AB3;">Ficha Libreta Sanitaria</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modal_solicitud">
                    <div class="card card flex-row flow flex-wrap">
                        <div class="card-header border-0" style="background-color: white!important;">
                            <img id="imagen-pefil-periodo" style="width:200px" src="" />
                        </div>
                        <div class="card-block px-2" id="card-detail-sol">
                            <h4 class="card-title"><span id="nombre-span-periodo"></span></h4>
                            <p class="card-text" style="margin-bottom:0rem;">DNI: <span id="dni-span-periodo"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Fecha Nacimiento: <span id="fe_nac-span-periodo"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Domicilio: <span id="dire-span-periodo"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Teléfono: <span id="tel-span-periodo"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Tipo de Empleo: <span id="tipo_empleo-span-periodo"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Es renovación: <span id="renovacion-span-periodo"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Capacitación: <span id="capacitacion-span-periodo"></span></p>
                            <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#comprobantePago" aria-expanded="false" aria-controls="comprobantePago">
                                Ver Comprobante de Pago
                            </button>
                            <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#capacitacion-periodo" aria-expanded="false" aria-controls="capacitacion-periodo" id="btn-capacitacion-periodo">
                                Ver Capacitación
                            </button>

                        </div>

                        <div class="card-block w-100 pb-3 container">
                            <div class="collapse" id="comprobantePago">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe id="comprobante-pago-span-periodo" class="embed-responsive-item" src="about:blank"></iframe>
                                </div>
                            </div>
                        </div>
                        <div id="div-capacitacion-periodo" class="card-block w-100 pb-3 container">
                            <div class="collapse" id="capacitacion-periodo">
                                <hr>
                                <h4 class="card-title">Capacitación</h4>
                                <p class="card-text" style="margin-bottom:0rem;">Nombre y Apellido Capacitador: <span id="nombre-capa-span-periodo"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Matrícula: <span id="matricula-span-periodo"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Capacitado en Municipalidad de Neuqu&eacute;n </p>
                                <p class="card-text" style="margin-bottom:0rem;">Lugar Capacitación: <span id="lugar-capa-span-periodo"></span></p>
                                <p class="card-text" style="margin-bottom:0rem;">Fecha Capacitación: <span id="fecha-capa-span-periodo"></span></p>
                                <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#verCertificado" aria-expanded="false" aria-controls="verCertificado">
                                    Ver Certificado
                                </button>
                            </div>
                            <div class="collapse" id="verCertificado">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe id="certificado-capa-periodo" class="embed-responsive-item" src="about:blank"></iframe>
                                </div>
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
                                        <td><span id="fecha-alta-span-periodo"></td>
                                        <td><span id="fecha-alta-mas-span-periodo"></td>
                                        <td><span id="nro-recibo-span-periodo"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="w-100"></div>
                        <div class="card-footer w-100 text-muted">
                            <p id="observaciones-span-periodo">Observaciones</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="id-solicitud-periodo" hidden></span>
                    <button type="button" class="btn btn-primary" onclick="imprimirLibreta()">Imprimir
                    </button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>