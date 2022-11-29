<?php
$fechaActual = now()->isoFormat('YYYY-MM-DD');
?>
@extends('app')
@section('title', 'Mis reportes')

@section('content')

<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <form action="/mis-reportes" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                        <select class="form-control buscador" name="estatus">
                            <option value="" disabled selected>Estatus</option>
                            <option {{ old('estatus') == 'En proceso' ? "selected" : "" }} value="En proceso">En proceso</option>
                            <option {{ old('estatus') == 'Finalizado' ? "selected" : "" }} value="Finalizado">Finalizado</option>
                            <option {{ old('estatus') == 'n' ? "selected" : "" }} value="n">Todos</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                        <select class="form-control buscador" name="comunidad">
                            <option value="" disabled selected>Comunidad</option>
                            @foreach ($comunidades as $comunidad)
                            <option {{ old("comunidad") == $comunidad->clave_comunidad ? "selected" : "" }} value="{{$comunidad->clave_comunidad}}">{{$comunidad->comunidad}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                        <input class="form-control buscador" type="date" name="fechaFiltro" value="{{Request::old('fechaFiltro')}}" max="<?php echo $fechaActual; ?>">
                    </div>
                    <div class="form-group col-12 col-lg-3 col-md-3 col-sm-12">
                        <button type="submit" class="btn btn-contenido boton-full mr-3"><i class="fa-solid fa-magnifying-glass mr-3"></i>Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <h5 class="text-center"><strong>MIS REPORTES</strong></h5>
    </div>

    <div class="container">
        <div class="tabla">
            <table class="table table-hover table-striped display responsive" id="tabla-lista-reportes" style="width:100%">
                <thead class="thead-style">
                    <tr>
                        <th>ID Reporte</th>
                        <th>Ciudad</th>
                        <th>Comunidad</th>
                        <th>Problema</th>
                        <th>Estatus</th>
                        <th>Fecha de registro</th>
                        <th class="none">Fecha de finalización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($misReportes as $miReporte)
                    <tr>
                        <td>{{$miReporte->clave_reporte}}</td>
                        <td>{{$miReporte->ciudad}}</td>
                        <td>{{$miReporte->comunidad}}</td>
                        <td>{{$miReporte->problema}}</td>
                        <td>{{$miReporte->estatus}}</td>
                        <td>{{$miReporte->fecha_reporte}}</td>
                        <td>{{$miReporte->fecha_finalizacion}}</td>
                        <td class="action-buttons">
                            @if ($miReporte->estatus == 'En proceso')
                            <a href="/detalle-reporte/{{$miReporte->clave_reporte}}" class="btn btn-reportar mr-3" title="Detalle"><i class="fa-solid fa-eye pr-1"></i><strong>Detalle</strong></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>



@endsection