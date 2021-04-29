<div class="modal" id="modalFicha" tabindex="-1" role="dialog">
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
                        <img class="" id="imagen-pefil-nuevo" style="width:200px" src="" />
                    </div>
                    <div class="card-block px-2" id="card-detail-sol">
                        <span hidden id="id-modal-nueva"></span>
                        <h5 class="card-title"><span id="nombre-span-nueva"></span></h5>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-credit-card-2-front"></i> DNI: <span id="dni-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-calendar-event"></i> Fecha Nacimiento: <span id="fe_nac-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-cursor"></i> Domicilio: <span id="dire-span-nueva"></span></p>
                        <p id="tel-usu-actualizado-nueva" class="card-text hideDiv" style="margin-bottom:0rem;"><i class=" text-info bi bi-telephone"></i> Teléfono Actualizado: <span id="tel-usu-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-telephone"></i> Teléfono: <span id="tel-span-nueva"></span></p>
                        <p id="email-usu-actualizado-nueva" class="card-text hideDiv" style="margin-bottom:0rem;"><i class=" text-info bi bi-envelope"></i> Email Actualizado: <span id="email-usu-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;"><i class=" text-info bi bi-envelope"></i> Email: <span id="email-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;">Tipo de Empleo: <span id="tipo_empleo-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;">Es renovación: <span id="renovacion-span-nueva"></span></p>
                        <p class="card-text" style="margin-bottom:0rem;">Capacitación: <span id="capacitacion-span-nueva"></span></p>
                        <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#comprobantePago" aria-expanded="false" aria-controls="comprobantePago">
                            Ver Comprobante de Pago
                        </button>
                        <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#capacitacion-nueva" aria-expanded="false" aria-controls="capacitacion-nueva" id="btn-capacitacion-nueva">
                            Ver Capacitación
                        </button>

                    </div>

                    <div class="card-block w-100 pb-3 container">
                        <div class="collapse" id="comprobantePago">
                            <div id="comprobante-pago-span-nueva"></div>
                            <!--                             <div class="embed-responsive embed-responsive-16by9" style="background-color: beige;">
                                <iframe id="comprobante-pago-span-nueva" class="embed-responsive-item" src="about:blank"></iframe>
                            </div> -->
                        </div>
                    </div>
                    <div id="div-capacitacion-nueva" class="card-block w-100 pb-3 container">
                        <div id="capacitacion-nueva" class="collapse">
                            <hr>
                            <h4 class="card-title">Capacitación</h4>
                            <p class="card-text" style="margin-bottom:0rem;">Nombre y Apellido Capacitador: <span id="nombre-capa-span-nueva"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Capacitado en Municipalidad de Neuqu&eacute;n: <span id="muni-capa-span-nueva"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Lugar Capacitación: <span id="lugar-capa-span-nueva"></span></p>
                            <p class="card-text" style="margin-bottom:0rem;">Fecha Capacitación: <span id="fecha-capa-span-nueva"></span></p>
                            <button class="btn btn-sm btn-primary my-3" type="button" data-toggle="collapse" data-target="#verCertificado" aria-expanded="false" aria-controls="verCertificado">
                                Ver Certificado
                            </button>
                        </div>

                        <div class="collapse" id="verCertificado">
                            <div id="certificado-capa-nueva"></div>
                            <!--                             <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="certificado-capa-nueva" class="embed-responsive-item" src="about:blank"></iframe>
                            </div> -->
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
                                    <td><?= date('d/m/Y') ?></td>
                                    <td><?= date('d/m/Y', strtotime('+1 year -1 day', strtotime(date('Y-m-d')))); ?></td>
                                    <td><span id="nro-recibo-span-nueva"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="w-100"></div>
                    <div class="card-footer w-100 text-muted">
                        <form action="#" method="POST" enctype="multipart/form-data" class="form-horizontal mx-auto needs-validation" name="form" id="form" novalidate>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="confirmacionCambiarEstado('Aprobado')">Aprobar</button>
                <button type="button" class="btn btn-primary" onclick="confirmacionCambiarEstado('Rechazado')" data-toggle="modal" href="#modalConfirmacion" style="background-color: #f54842; border-color: #f54842;">Rechazar</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>