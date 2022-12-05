@extends('app')
@section('title', 'Administrar comunidades')

@section('content')
<section class="cuerpo mb-4">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-4 col-md-4 col-sm-12">
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 pb-2">
                        <h5 class="text-center"> <strong>ADMINISTRAR CIUDADES & MUNICIPIOS</strong></h5>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 btn-derecha">
                        <button class="btn btn-contenido" data-toggle="modal" data-target="#city-add-modal"><strong>Nueva ciudad</strong></button>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="tabla">
                            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-clientes" style="width:100%">
                                <thead class="thead-style">
                                    <tr>
                                        <th>ID</th>
                                        <th>Ciudad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @foreach ($ciudades as $ciudad)
                                    <tr>
                                        <td>{{$ciudad->clave_ciudad}}</td>
                                        <td>{{$ciudad->ciudad}}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-id="{{$ciudad->clave_ciudad}}" data-city="{{$ciudad->ciudad}}" data-target="#city-edit-modal"><i class="fa-solid fa-pen-to-square pr-1"></i><strong>Editar</strong></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-1 col-md-1 col-sm-12 mb-4 mt-4"></div>
            <div class="col-12 col-lg-7 col-md-7 col-sm-12">
                <div class="row">
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 pb-2">
                        <h5 class="text-center"> <strong>ADMINISTRAR COMUNIDADES</strong></h5>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12 btn-derecha">
                        <button class="btn btn-contenido" data-toggle="modal" data-target="#community-add-modal"><strong>Nueva comunidad</strong></button>
                    </div>
                    <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="tabla">
                            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-comunidades" style="width:100%">
                                <thead class="thead-style">
                                    <tr>
                                        <th>ID</th>
                                        <th>Comunidad</th>
                                        <th>Ciudad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @foreach ($comunidades as $comunidad)
                                    <tr>
                                        <td>{{$comunidad->clave_comunidad}}</td>
                                        <td>{{$comunidad->comunidad}}</td>
                                        <td>{{$comunidad->ciudad}}</td>
                                        <td class="action-buttons">
                                            <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-id="{{$comunidad->clave_comunidad}}" data-comun="{{$comunidad->comunidad}}" data-city="{{$comunidad->fk_ciudad}}" data-target="#community-edit-modal"><i class="fa-solid fa-pen-to-square pr-1"></i><strong>Editar</strong></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR CIUDADES -->
    <div class="modal fade" id="city-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Registrar ciudad</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-ciudades" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre ciudad:</strong></label>
                            <input type="text" name="ciudad" maxlength="50" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Registrar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR CIUDADES -->
    <div class="modal fade" id="city-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-ciudades/editar" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id-ciudad" class="form-control" hidden>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre ciudad:</strong></label>
                            <input type="text" name="ciudad" id="input-ciudad" maxlength="50" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR COMUNIDADES -->
    <div class="modal fade" id="community-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Registrar comunidad</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-comunidades" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre comunidad:</strong></label>
                            <input type="text" name="comunidad" class="form-control" maxlength="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <select class="form-control" name="fk_ciudad" required>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Registrar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA EDITAR COMUNIDADES -->
    <div class="modal fade" id="community-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-comunidades/editar" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id-comunidad" class="form-control" hidden>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre comunidad:</strong></label>
                            <input type="text" name="comunidad" id="input-comunidad" class="form-control" maxlength="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <select class="form-control" id="select-ciudad" name="fk_ciudad" required>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection