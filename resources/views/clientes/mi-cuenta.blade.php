@extends('app')
@section('title', 'Mi Cuenta')

@section('content')

<section class="cuerpo mb-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-7 col-md-7 col-sm-12 pb-2">
                <div class="tarjeta-clientes">
                    <div class="container text-center pt-2">
                        <h5 class="text-center"><strong>MI DATOS</strong></h5>
                    </div>
                    <div class="separador"></div>
                    @foreach ($miCuenta as $mc)
                    <div class="m-3">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Número de Cliente:</strong> {{$mc->fk_clave_persona}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre del Titular:</strong> {{$mc->nombre}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong> {{$mc->ciudad}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Comunidad:</strong> {{$mc->comunidad}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Dirección:</strong> {{$mc->direccion}} #{{$mc->nexterior}}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 col-lg-5 col-md-5 col-sm-12 pb-2">
                <div class="tarjeta-clientes">
                    <div class="container text-center pt-2">
                        <h5 class="text-center"><strong>MI SERVICIO</strong></h5>
                    </div>
                    <div class="separador"></div>
                    @foreach ($miCuenta as $mc)
                    <div class="m-3">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Clave de servicio:</strong> {{$mc->clave_servicio}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Servicio Contratado:</strong> Internet {{$mc->velocidad}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Costo del Servicio:</strong> ${{$mc->costo}} MXN</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Periodo de Pago:</strong> {{$mc->periodo}}</label>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label">
                                <strong>Estado del Servicio:</strong>
                                @if ($mc->estatus == 1)
                                Activo
                                @elseif ($mc->estatus == 0)
                                Inactivo
                                @endif
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="row mt-3">
            @if ($miCuenta[0]->estatus == 1)
            <div class="col-12 col-lg-7 col-md-7 col-sm-12 pb-2">
                <div class="tarjeta-clientes">
                    <div class="container text-center pt-2">
                        <h5 class="text-center"><strong>REPORTAR UN PROBLEMA</strong></h5>
                    </div>
                    <div class="separador"></div>
                    <form action="/mi-cuenta" method="POST">
                        @csrf
                        <div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="fk_servicio" value="{{$miCuenta[0]->clave_servicio}}" required>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label"><strong>¿Cúal es tu problema?</strong> </label>
                                    <textarea rows="5" id="problema-cliente" class="form-control" name="problema" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="boton-pie">
                            <button type="button" class="btn btn-contenido" data-toggle="modal" data-target="#alert-enviar-reporte"><strong>Enviar Reporte</strong></button>
                        </div>
                        <button type="submit" class="btn" id="btn-send-report" hidden></button>
                    </form>
                </div>
            </div>
            @endif
            <div class="col-12 col-lg-5 col-md-5 col-sm-12 pb-2">
                <div class="tarjeta-clientes">
                    <div class="container text-center pt-2">
                        <h5 class="text-center"><strong>REPORTES ACTIVOS</strong></h5>
                    </div>
                    <div class="separador"></div>
                    <div class="clientes-reportes-activos">
                        @foreach ($activos as $activo)
                        <div class="tarjeta-reporte">
                            <div class="ml-3 mr-3">
                                <label for="recipient-name" class="col-form-label"><strong>Problema:</strong></label>
                                <p>{{$activo->problema}}</p>
                                <div class="separar-datos">
                                    <label for="recipient-name" class="col-form-label"><strong>Estatus:</strong> {{$activo->estatus}}</label>
                                    <label for="recipient-name" class="col-form-label"><strong>Fecha:</strong> {{$activo->fecha_reporte}}</label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if ($activos == null)
                        <div class="container mx-auto">
                            <p class="empty-message">No tienes reportes activos.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE CONFIRMACIÓN PARA ENVIAR UN REPORTE -->
    <div class="container alerta info">
        <div class="modal fade" id="alert-enviar-reporte">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header-center">
                        <h5 class="modal-title text-center"><em class="fa-lg fa-solid fa-circle-info"></em><strong>Atención</strong></h5>
                    </div>
                    <div class="modal-body cuerpo-modal">
                        <div>
                            <p align="justify" id="p-mensaje">
                                Si ya ha reportado este problema vía telefónica, por favor no vuelva a enviar este reporte.
                                En su lugar comuniquese al teléfono de atención al cliente para pedir información o consulte
                                su estatus en el apartado de REPORTES ACTIVOS.
                            </p>
                        </div>
                    </div>
                    <div class="ml-3 mb-3">
                        <input type="checkbox" class="mr-2" id="cbx-enviar-reporte">Entiendo y deseo continuar.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-contenido" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-contenido" id="btn-enviar-reporte" disabled>Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection