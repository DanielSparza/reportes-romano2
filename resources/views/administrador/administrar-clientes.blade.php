@extends('app')
@section('title', 'Administrar clientes')

@section('content')
<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <div class="row">
                <div class="form-group col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="input-group buscador icono-buscador">
                        <input type="text" class="form-control buscador-general" id="admin-buscar-cliente" placeholder="Buscar cliente" aria-label="Página actual" aria-describedby="button-addon2">
                        <p class="icon-clean-input" id="icono-borrar-usuarios"><i class="fa-solid fa-circle-xmark"></i></p>
                    </div>
                </div>
                <div class=" col-12 col-lg-6 col-md-6 col-sm-12 btn-derecha">
                    <button class="btn btn-contenido" data-toggle="modal" data-target="#customer-add-modal" onclick="cargarComunidades('select-ciudad')"><strong>Registrar nuevo</strong></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h5 class="text-center"> <strong>ADMINISTRAR CLIENTES</strong></h5>
    </div>

    <div class="container">
        <div class="tabla">
            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-clientes" style="width:100%">
                <thead class="thead-style">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>No. Exterior</th>
                        <th>No. Interior</th>
                        <th>Colonia</th>
                        <th>Comunidad</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Teléfono fijo</th>
                        <th>Teléfono móvil</th>
                        <th>Estatus</th>
                        <th>Paquete</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Foto fachada</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="tabla-clientes-admin">
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->fk_clave_persona}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->direccion}}</td>
                        <td>{{$cliente->nexterior}}</td>
                        <td>{{$cliente->ninterior}}</td>
                        <td>{{$cliente->colonia}}</td>
                        <td>{{$cliente->comunidad}}</td>
                        <td>{{$cliente->ciudad}}</td>
                        <td>{{$cliente->estado}}</td>
                        <td>{{$cliente->telefono_fijo}}</td>
                        <td>{{$cliente->telefono_movil}}</td>
                        <td>
                            @if ($cliente->estatus == 1)
                            Activo
                            @elseif ($cliente->estatus == 0)
                            Inactivo
                            @endif
                        </td>
                        <td>{{$cliente->velocidad}}</td>
                        <td>{{$cliente->latitud}}</td>
                        <td>{{$cliente->longitud}}</td>
                        <td>
                            @if ($cliente->foto_fachada != null)
                            <img class="img-tabla-sm" src="{{$cliente->foto_fachada}}" alt="imagen de la fachada del cliente">
                            @else
                            No hay foto disponible
                            @endif
                        </td>
                        <td class="action-buttons">
                            <button class="btn btn-reportar mr-3" title="Editar" onclick="cargarComunidades('select-ciudad-editar')" data-toggle="modal" data-target="#customer-edit-modal" data-foto="{{$cliente->foto_fachada}}" data-cservicio="{{$cliente->clave_servicio}}" data-lon="{{$cliente->longitud}}" data-lat="{{$cliente->latitud}}" data-vel="{{$cliente->fk_paquete}}" data-est="{{$cliente->estatus}}" data-mov="{{$cliente->telefono_movil}}" data-fijo="{{$cliente->telefono_fijo}}" data-estado="{{$cliente->estado}}" data-city="{{$cliente->fk_ciudad}}" data-com="{{$cliente->fk_comunidad}}" data-col="{{$cliente->colonia}}" data-nin="{{$cliente->ninterior}}" data-nex="{{$cliente->nexterior}}" data-dir="{{$cliente->direccion}}" data-nom="{{$cliente->nombre}}" data-id="{{$cliente->fk_clave_persona}}">
                                <i class="fa-solid fa-pen-to-square pr-1"></i><strong>Editar</strong>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL PARA EDITAR CLIENTES -->
    <div class="modal fade" id="customer-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-clientes/editar" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id-cliente" class="form-control" required hidden>
                        </div>
                        <div>
                            <input type="text" name="clave_servicio" id="input-id-servicio" class="form-control" required hidden>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre:</strong></label>
                            <input type="text" name="nombre" id="input-nombre" class="form-control" maxlength="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Dirección:</strong></label>
                            <input type="text" name="direccion" id="input-direccion" class="form-control" maxlength="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Número exterior:</strong></label>
                            <input type="text" name="nexterior" id="input-nexterior" class="form-control" maxlength="10" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Número interior:</strong></label>
                            <input type="text" name="ninterior" id="input-ninterior" class="form-control">
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Colónia:</strong></label>
                            <input type="text" name="colonia" id="input-colonia" class="form-control">
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <select class="form-control" name="fk_ciudad" id="select-ciudad-editar" required>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Comunidad:</strong></label>
                            <select class="form-control" name="fk_comunidad" id="select-comunidad-editar" required>
                                
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Estado:</strong></label>
                            <input type="text" name="estado" id="input-estado" class="form-control" maxlength="30" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Teléfono fijo:</strong></label>
                            <input type="text" name="telefono_fijo" id="input-telfijo" class="form-control">
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Teléfono móvil:</strong></label>
                            <input type="text" name="telefono_movil" id="input-telmovil" class="form-control" maxlength="20" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Estatus:</strong></label>
                            <select class="form-control" name="estatus" id="select-estatus" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Servicio contratado:</strong></label>
                            <select class="form-control" name="fk_paquete" id="select-paquete" required>
                                @foreach ($paquetes as $paquete)
                                <option value="{{$paquete->clave_paquete}}">{{$paquete->velocidad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-4">
                            <label for="recipient-name" class="col-form-label"><strong>Datos de ubicación</strong></label>
                            <div class="separador"></div>
                            <div class="container pb-4">
                                <label for="recipient-name" class="col-form-label"><strong>Latitud:</strong></label>
                                <input type="text" name="latitud" id="input-latitud" class="form-control">
                                <label for="recipient-name" class="col-form-label"><strong>Longitud:</strong></label>
                                <input type="text" name="longitud" id="input-longitud" class="form-control">
                            </div>
                            <div class="separador"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1"><strong>Foto de la fachada:</strong></label>
                            <input type="file" class="form-control-file" name="foto_fachada" accept="image/*">
                        </div>
                        <div>
                            <input type="text" name="foto_actual" id="input-foto-actual" class="form-control" hidden>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR CLIENTES -->
    <div class="modal fade" id="customer-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Registrar cliente</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-clientes" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre:</strong></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" maxlength="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Dirección:</strong></label>
                            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" maxlength="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Número exterior:</strong></label>
                            <input type="text" name="nexterior" class="form-control" value="{{ old('nexterior') }}" maxlength="10" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Número interior:</strong></label>
                            <input type="text" name="ninterior" class="form-control" value="{{ old('ninterior') }}">
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Colónia:</strong></label>
                            <input type="text" name="colonia" class="form-control" value="{{ old('colonia') }}">
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <select class="form-control" name="fk_ciudad" id="select-ciudad" required>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Comunidad:</strong></label>
                            <select class="form-control" name="fk_comunidad" id="select-comunidad" required>
                               
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Estado:</strong></label>
                            <input type="text" name="estado" class="form-control" value="{{ old('estado') }}" maxlength="30" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Teléfono fijo:</strong></label>
                            <input type="text" name="telefono_fijo" class="form-control" value="{{ old('telefono_fijo') }}">
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Teléfono móvil:</strong></label>
                            <input type="text" name="telefono_movil" class="form-control" value="{{ old('telefono_movil') }}" maxlength="20" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Estatus:</strong></label>
                            <select class="form-control" name="estatus" value="{{ old('estatus') }}" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Servicio contratado:</strong></label>
                            <select class="form-control" name="fk_paquete" value="{{ old('fk_paquete') }}" required>
                                @foreach ($paquetes as $paquete)
                                <option value="{{$paquete->clave_paquete}}">{{$paquete->velocidad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-4">
                            <label for="recipient-name" class="col-form-label"><strong>Datos de ubicación</strong></label>
                            <div class="separador"></div>
                            <div class="container pb-4">
                                <label for="recipient-name" class="col-form-label"><strong>Latitud:</strong></label>
                                <input type="text" name="latitud" class="form-control" value="{{ old('latitud') }}">
                                <label for="recipient-name" class="col-form-label"><strong>Longitud:</strong></label>
                                <input type="text" name="longitud" class="form-control" value="{{ old('longitud') }}">
                            </div>
                            <div class="separador"></div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1"><strong>Foto de la fachada:</strong></label>
                            <input type="file" name="foto_fachada" class="form-control-file" accept="image/*">
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