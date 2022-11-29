@extends('app')
@section('title', 'Reportes pendientes')

@section('content')
<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <form action="/reportes-pendientes" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-12 col-lg-4 col-md-4 col-sm-12">
                        <select class="form-control buscador" name="ciudad" id="select-ciudad-pendientes" value="{{Request::old('ciudad')}}">
                            <option value="" disabled selected>Ciudad</option>
                            @foreach ($ciudades as $ciudad)
                            <option {{ old("ciudad") == $ciudad->clave_ciudad ? "selected" : "" }} value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12 col-lg-4 col-md-4 col-sm-12">
                        <select class="form-control buscador" name="comunidad" id="select-comunidad-pendientes" >
                            <option value="" disabled selected>Comunidad</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-lg-2 col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-contenido boton-full"><i class="fa-solid fa-magnifying-glass mr-3"></i>Filtrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function miFuncion() {
            setTimeout(function() {
                //alert('SE HA RECARGADO LA PAGINA XD');
                cargarComunidades('select-ciudad-pendientes');
            }, 5000);
            dispararAlerta();
        }
        window.onload = miFuncion;
    </script>

    <div class="container">
        <h5 class="text-center"><strong>REPORTES PENDIENTES</strong></h5>
    </div>

    <div class="container">
        <div class="tabla">
            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-reportes" style="width:100%">
                <thead class="thead-style">
                    <tr>
                        <th>ID Reporte</th>
                        <th>Ciudad</th>
                        <th>Comunidad</th>
                        <th>Problema</th>
                        <th>Fecha de registro</th>
                        <th>Veces reportado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body">
                    @foreach ($pendientes as $pendiente)
                    <tr>
                        <td>{{$pendiente->clave_reporte}}</td>
                        <td>{{$pendiente->ciudad}}</td>
                        <td>{{$pendiente->comunidad}}</td>
                        <td>{{$pendiente->problema}}</td>
                        <td>{{$pendiente->fecha_reporte}}</td>
                        <td>{{$pendiente->veces_reportado}}</td>
                        <td class="action-buttons">
                            <a href="/detalle-reporte-atender/{{$pendiente->clave_reporte}}" class="btn btn-reportar mr-3" title="Detalle">
                                <i class="fa-solid fa-wrench pr-1"></i><strong>Atender</strong>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>



@endsection