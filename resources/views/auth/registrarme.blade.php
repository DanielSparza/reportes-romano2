@extends('app')
@section('title', 'Registrarme')

@section('content')
<section class="cuerpo mb-4">
    <div class="container">
        <div class="tarjeta-clientes form-auth">
            <div class="container text-center pt-2">
                <h5 class="text-center"><strong>REGISTRARME</strong></h5>
            </div>
            <div class="separador"></div>
            <form action="registrarme" method="POST" id="formulario-usuarios">
                @csrf
                <div>
                    <div class="modal-body">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Número de cliente:</strong></label>
                            <input type="text" name="clave_cliente" class="form-control" value="{{ old('clave_cliente') }}" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre del titular:</strong></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" max="100" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre de usuario:</strong></label>
                            <input type="text" name="usuario" class="form-control" value="{{ old('usuario') }}" max="20" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Email:</strong></label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" max="50" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Contraseña:</strong></label>
                            <input type="password" name="password" id="contrasena-add" class="form-control" min="8" max="30" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Confirmar contraseña:</strong></label>
                            <input type="password" name="password_confirmation" id="confirmar-contrasena-add" class="form-control" min="8" max="30" required>
                        </div>
                        <p class="form-password-match-error"><i class="fa-solid fa-circle-exclamation mr-2"></i><strong>Las contraseñas no coinciden.</strong></p>
                    </div>
                </div>
                <div class="separador"></div>
                <div class="boton-pie">
                    <button type="submit" id="btn-save-user" class="btn btn-contenido"><strong>Registrarme</strong></button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection