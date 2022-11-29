@extends('app')
@section('title', 'Levantar reportes')

@section('content')

<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <div class="row">
                <div class="col-12 col-lg-10 col-md-10 col-sm-12">
                    <div class="row">
                        <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                            <div class="input-group buscador icono-buscador">
                                <input type="text" class="form-control buscador-general" id="reportes-buscar-cliente" placeholder="Buscar cliente" aria-label="Página actual" aria-describedby="button-addon2">
                                <p class="icon-clean-input" id="icono-borrar-usuarios"><i class="fa-solid fa-circle-xmark"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h5 class="text-center"> <strong>CLIENTES</strong></h5>
    </div>

    <div class="container">
        <div class="tabla">
            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-clientes" style="width:100%">
                <thead class="thead-style">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Ciudad</th>
                        <th>Comunidad</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="tabla-clientes-reportes">
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->fk_clave_persona}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->ciudad}}</td>
                        <td>{{$cliente->comunidad}}</td>
                        <td>{{$cliente->direccion}} #{{$cliente->nexterior}}</td>
                        <td class="action-buttons">
                            <button class="btn btn-reportar mr-3" title="Reporte" data-toggle="modal" data-target="#client-report-modal" data-com="{{$cliente->comunidad}}" data-serv="{{$cliente->clave_servicio}}" data-nom="{{$cliente->nombre}}" data-city="{{$cliente->ciudad}}">
                                <i class="fa-solid fa-pen-to-square pr-1"></i><strong>Nuevo reporte</strong>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL PARA LEBANTAR REPORTES -->
    <div class="modal fade" id="client-report-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/levantar-reportes" method="POST">
                @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="fk_servicio" id="input-clave-servicio" class="form-control" required hidden>
                        </div>
                        <div>
                            <label for="" class="col-form-label"><strong>Cliente: </strong> </label>
                            <label for="recipient-name" class="col-form-label" id="lbl-cliente"> </label>
                        </div>
                        <div>
                            <label for="" class="col-form-label"><strong>Ciudad: </strong> </label>
                            <label for="recipient-name" class="col-form-label" id="lbl-ciudad"> </label>
                        </div>
                        <div>
                            <label for="" class="col-form-label"><strong>Comunidad: </strong> </label>
                            <label for="recipient-name" class="col-form-label" id="lbl-comunidad"> </strong> </label>
                        </div>
                        <div class="form-group pt-3">
                            <label for="message-text" class="col-form-label"><strong>Problema:</strong> </label>
                            <textarea rows="4" class="form-control" name="problema" required></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Registrar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection