@extends('app')
@section('title', 'Administrar usuarios')

@section('content')
<section class="cuerpo mb-4">
    <div class="container">
        <div class="filter_options">
            <div class="row">
                <div class="form-group col-12 col-lg-6 col-md-6 col-sm-12">
                    <div class="input-group buscador icono-buscador">
                        <input type="text" class="form-control buscador-general" id="admin-buscar-usuario" placeholder="Buscar usuario" aria-label="Página actual" aria-describedby="button-addon2" name="usuario">
                        <p class="icon-clean-input" id="icono-borrar-usuarios"><i class="fa-solid fa-circle-xmark"></i></p>
                    </div>
                </div>
                <div class=" col-12 col-lg-6 col-md-6 col-sm-12 btn-derecha">
                    <button class="btn btn-contenido" data-toggle="modal" data-target="#user-add-modal"><strong>Registrar nuevo</strong></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h5 class="text-center"> <strong>ADMINISTRAR USUARIOS</strong></h5>
    </div>

    <div class="container">
        <div class="tabla">
            <table class="table table-hover table-striped display responsive nowrap" id="tabla-lista-clientes" style="width:100%">
                <thead class="thead-style">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Ciudad</th>
                        <th>Teléfono</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-body" id="tabla-usuarios-admin">
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{$usuario->fk_clave_persona}}</td>
                        <td>{{$usuario->nombre}}</td>
                        <td>{{$usuario->ciudad}}</td>
                        <td>{{$usuario->telefono_movil}}</td>
                        <td>{{$usuario->usuario}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->rol}}</td>
                        <td>
                            @if ($usuario->estatus == 1)
                            Activo
                            @elseif ($usuario->estatus == 0)
                            Inactivo
                            @endif
                        </td>
                        <td class="action-buttons">
                            <button class="btn btn-reportar mr-3" title="Editar" data-toggle="modal" data-target="#user-edit-modal" data-id="{{$usuario->fk_clave_persona}}" data-nom="{{$usuario->nombre}}" data-city="{{$usuario->fk_ciudad}}" data-tel="{{$usuario->telefono_movil}}" data-usr="{{$usuario->usuario}}" data-mail="{{$usuario->email}}" data-rol="{{$usuario->fk_rol}}" data-est="{{$usuario->estatus}}">
                                <i class="fa-solid fa-pen-to-square pr-1"></i><strong>Editar</strong>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL PARA EDITAR USUARIOS -->
    <div class="modal fade" id="user-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>New message</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-usuarios/editar" method="POST" id="formulario-editar-usuarios">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <input type="text" name="id" id="input-id-usuario" class="form-control" hidden>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre:</strong></label>
                            <input type="text" name="nombre" id="input-nombre" class="form-control" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <select class="form-control" name="fk_ciudad" id="select-ciudad">
                                @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Teléfono:</strong></label>
                            <input type="text" name="telefono_movil" id="input-telefono" class="form-control" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre de usuario:</strong></label>
                            <input type="text" name="usuario" id="input-usuario" class="form-control" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Email:</strong></label>
                            <input type="email" name="email" class="form-control" id="input-email" maxlength="50" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Rol:</strong></label>
                            <select class="form-control" name="fk_rol" id="select-rol">
                                @foreach ($roles as $rol)
                                <option value="{{$rol->clave_rol}}">{{$rol->rol}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Estatus:</strong></label>
                            <select class="form-control" name="estatus" id="select-estatus">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div>
                            <div class="form-group form-check mt-4">
                                <input type="checkbox" class="form-check-input" id="cb-cambiar-contrasena" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <label class="form-check-label" for="exampleCheck1"><strong>Cambiar contraseña</strong></label>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <label for="recipient-name" class="col-form-label"><strong>Nueva contraseña:</strong></label>
                                <input type="password" name="password" id="ipt-contrasena" class="form-control">
                                <label for="recipient-name" class="col-form-label"><strong>Confirmar contraseña:</strong></label>
                                <input type="password" name="password_confirmation" id="ipt-confirmar-contrasena" class="form-control">
                            </div>
                            <p class="form-password-match-error"><i class="fa-solid fa-circle-exclamation mr-2"></i><strong>Las contraseñas no coinciden.</strong></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-edit-user" class="btn btn-reportar"><strong>Guardar cambios</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR USUARIOS -->
    <div class="modal fade" id="user-add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><strong>Registrar usuario</strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/administrar-usuarios" method="POST" id="formulario-usuarios">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre:</strong></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" maxlength="100" required autofocus>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Ciudad:</strong></label>
                            <select class="form-control" name="fk_ciudad" value="{{ old('fk_ciudad') }}" required>
                                @foreach ($ciudades as $ciudad)
                                <option value="{{$ciudad->clave_ciudad}}">{{$ciudad->ciudad}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Teléfono:</strong></label>
                            <input type="text" name="telefono_movil" class="form-control" value="{{ old('telefono_movil') }}" maxlength="20" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre de usuario:</strong></label>
                            <input type="text" name="usuario" class="form-control" value="{{ old('usuario') }}" minlength="5" maxlength="20" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Email:</strong></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" maxlength="50" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Rol:</strong></label>
                            <select class="form-control" name="fk_rol" value="{{ old('fk_rol') }}" required>
                                @foreach ($roles as $rol)
                                <option value="{{$rol->clave_rol}}">{{$rol->rol}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Estatus:</strong></label>
                            <select class="form-control" name="estatus" value="{{ old('estatus') }}" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Contraseña:</strong></label>
                            <input type="password" name="password" id="contrasena-add" class="form-control" minlength="8" maxlength="30" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Confirmar contraseña:</strong></label>
                            <input type="password" name="password_confirmation" id="confirmar-contrasena-add" class="form-control" minlength="8" maxlength="30" required>
                        </div>
                        <p class="form-password-match-error"><i class="fa-solid fa-circle-exclamation mr-2"></i><strong>Las contraseñas no coinciden.</strong></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-save-user" class="btn btn-reportar"><strong>Registrar</strong></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection