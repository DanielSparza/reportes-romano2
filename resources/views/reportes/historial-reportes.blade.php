<?php
//$fecha = date("Y-m-d");
$fechaActual = now()->isoFormat('YYYY-MM-DD');
?>

@extends('app')
@section('title', 'Historial reportes')

@section('content')

<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <form action="historial-reportes" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-5 col-md-5 col-sm-12">
                        <div class="input-group buscador icono-buscador mb-3">
                            <input type="text" class="form-control buscador-general" placeholder="Buscar cliente" id="historial-buscar-reporte" aria-label="Página actual" aria-describedby="button-addon2">
                            <p class="icon-clean-input" id="icono-borrar-usuarios"><i class="fa-solid fa-circle-xmark"></i></p>
                        </div>
                    </div>
                    <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                        <select class="form-control buscador" name="estatus" value="{{Request::old('estatus')}}">
                            <option value="" disabled selected>Estatus</option>
                            <option {{ old('estatus') == 'Pendiente' ? "selected" : "" }} value="Pendiente">Pendiente</option>
                            <option {{ old('estatus') == 'En proceso' ? "selected" : "" }} value="En proceso">En proceso</option>
                            <option {{ old('estatus') == 'Finalizado' ? "selected" : "" }} value="Finalizado">Finalizado</option>
                            <option {{ old('estatus') == 'n' ? "selected" : "" }} value="n">Todos</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-lg-2 col-md-2 col-sm-12">
                        <input class="form-control buscador" type="date" name="fecha_filtro" value="{{Request::old('fecha_filtro')}}" max="<?php echo $fechaActual; ?>">
                    </div>
                    <div class="form-group col-12 col-lg-2 col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-contenido boton-full"><i class="fa-solid fa-magnifying-glass mr-3"></i>Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <h5 class="text-center"><strong>HISTORIAL REPORTES</strong></h5>
    </div>

    <div class="container">
        <div class="tabla">
            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-clientes" style="width:100%">
                <thead class="thead-style">
                    <tr>
                        <th>ID Reporte</th>
                        <th>Cliente</th>
                        <th>Problema</th>
                        <th>Fecha registro</th>
                        <th>Estatus</th>
                        <th>Técnico</th>
                        <th>Veces reportado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="tabla-historial-reportes">
                    @foreach ($reportes as $reporte)
                    <tr>
                        <td>{{$reporte->clave_reporte}}</td>
                        <td>{{$reporte->cliente}}</td>
                        <td>{{$reporte->problema}}</td>
                        <td>{{$reporte->fecha_reporte}}</td>
                        <td>{{$reporte->estatus}}</td>
                        <td>{{$reporte->tecnico}}</td>
                        <td>{{$reporte->veces_reportado}}</td>
                        <td class="action-buttons">
                            <button class="btn btn-reportar mr-3" title="Detalle" data-toggle="modal" data-target="#view-report-modal" data-rep="{{$reporte->reporto}}" data-obs="{{$reporte->observaciones}}" data-vec="{{$reporte->veces_reportado}}" data-pro="{{$reporte->problema}}" data-tec="{{$reporte->tecnico}}" data-hfi="{{$reporte->hora_finalizacion}}" data-ffi="{{$reporte->fecha_finalizacion}}" data-hre="{{$reporte->hora_reporte}}" data-fre="{{$reporte->fecha_reporte}}" data-nex="{{$reporte->nexterior}}" data-dir="{{$reporte->direccion}}" data-com="{{$reporte->comunidad}}" data-city="{{$reporte->ciudad}}" data-cli="{{$reporte->cliente}}" data-id="{{$reporte->clave_reporte}}">
                                <i class="fa-solid fa-eye pr-1"></i><strong>Detalle</strong>
                            </button>
                            @if ($reporte->estatus === "Pendiente")
                            <button class="btn btn-editar mr-3" title="Editar" data-toggle="modal" data-target="#edit-report-modal" data-pro="{{$reporte->problema}}" data-nex="{{$reporte->nexterior}}" data-dir="{{$reporte->direccion}}" data-com="{{$reporte->comunidad}}" data-city="{{$reporte->ciudad}}" data-cli="{{$reporte->cliente}}" data-id="{{$reporte->clave_reporte}}">
                                <i class="fa-solid fa-pen-to-square pr-1"></i><strong>Editar</strong>
                            </button>
                            <button class="btn btn-aumentar" title="Aumentar número de reporte" data-toggle="modal" data-target="#alert-modal-reportes" data-id="{{$reporte->clave_reporte}}">✚</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL PARA VER DETALLE DE REPORTES -->
    <div class="modal fade" id="view-report-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="col-form-label"><strong>Cliente: </strong> </label>
                        <label class="col-form-label" id="lbl-cliente"> </label>
                    </div>
                    <div>
                        <label class="col-form-label"><strong>Ciudad: </strong> </label>
                        <label class="col-form-label" id="lbl-ciudad"> </label>
                    </div>
                    <div>
                        <label class="col-form-label"><strong>Comunidad: </strong> </label>
                        <label class="col-form-label" id="lbl-comunidad"> </label>
                    </div>
                    <div>
                        <label class="col-form-label"><strong>Dirección: </strong> </label>
                        <label class="col-form-label" id="lbl-direccion"> </label>
                        <label class="col-form-label" id="lbl-nexterior"> </label>
                    </div>
                    <div class="separar-datos">
                        <div>
                            <label class="col-form-label"><strong>Fecha registro: </strong> </label>
                            <label class="col-form-label" id="lbl-fechaReporte"> </label>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Hora registro: </strong> </label>
                            <label class="col-form-label" id="lbl-horaReporte"> </label>
                        </div>
                    </div>
                    <div class="separar-datos">
                        <div>
                            <label class="col-form-label"><strong>Fecha finalización: </strong> </label>
                            <label class="col-form-label" id="lbl-fechaFinalizacion"> </label>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Hora finalización: </strong> </label>
                            <label class="col-form-label" id="lbl-horaFinalizacion"> </label>
                        </div>
                    </div>
                    <div class="separar-datos">
                        <div>
                            <label class="col-form-label"><strong>Técnico: </strong> </label>
                            <label class="col-form-label" id="lbl-tecnico"> </label>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Registró: </strong> </label>
                            <label class="col-form-label" id="lbl-reporto"> </label>
                        </div>
                    </div>
                    <div>
                        <label class="col-form-label"><strong>Problema: </strong> </label>
                        <label class="col-form-label" id="lbl-problema"> </label>
                    </div>
                    <div>
                        <label class="col-form-label"><strong>Veces reportado: </strong> </label>
                        <label class="col-form-label" id="lbl-vecesReportado"> </label>
                    </div>
                    <div>
                        <label class="col-form-label"><strong>Observaciones del técnico: </strong> </label>
                        <label class="col-form-label" id="lbl-observaciones"> </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR REPORTES -->
    <div class="modal fade" id="edit-report-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/historial-reportes-editar" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="clave_reporte" id="historial-clave-reporte" class="form-control" required hidden>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Cliente: </strong></label>
                            <label class="col-form-label" id="lbl-editar-cliente"></label>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Ciudad: </strong></label>
                            <label class="col-form-label" id="lbl-editar-ciudad"></label>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Comunidad: </strong></label>
                            <label class="col-form-label" id="lbl-editar-comunidad"></label>
                        </div>
                        <div>
                            <label class="col-form-label"><strong>Dirección: </strong></label>
                            <label class="col-form-label" id="lbl-editar-direccion"></label>
                            <label class="col-form-label" id="lbl-editar-nexterior"></label>
                        </div>
                        <div class="form-group pt-3">
                            <label class="col-form-label"><strong>Problema: </strong></label>
                            <textarea rows="4" class="form-control" name="problema" id="txt-editar-problema" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-editar"><strong>Guardar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL DE CONFIRMACIÓN PARA AUMENTAR EL NÚMERO DE VECES REPORTADO -->
    <div class="container alerta info">
        <div class="modal fade" id="alert-modal-reportes">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header-center">
                        <h5 class="modal-title text-center"><em class="fa-lg fa-solid fa-circle-info"></em><strong>Atención</strong></h5>
                    </div>
                    <form action="/historial-reportes-aumentar" method="POST">
                        @csrf
                        <div class="modal-body cuerpo-modal">
                            <input type="text" name="clave_reporte" id="aumentar-clave-reporte" class="form-control" required hidden>
                            <p id="p-mensaje"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-contenido" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-finalizar">Aceptar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection