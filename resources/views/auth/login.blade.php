@extends('app')
@section('title', 'Iniciar sesión')

@section('content')
<section class="cuerpo mb-4">
    <div class="container center-form">
        <div class="tarjeta-clientes form-auth">
            <div class="container text-center pt-2">
                <h5 class="text-center"><strong>INICIAR SESIÓN</strong></h5>
            </div>
            <div class="separador"></div>
            <form action="login" method="POST">
                @csrf
                <div>
                    <div class="modal-body">
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Nombre de usuario o email:</strong></label>
                            <input type="text" name="usuario" class="form-control" required>
                        </div>
                        <div>
                            <label for="recipient-name" class="col-form-label"><strong>Contraseña:</strong></label>
                            <input type="password" name="password" class="form-control" min="8" max="30" required>
                        </div>
                    </div>
                </div>
                <div class="separador"></div>
                <div class="boton-pie">
                    <button type="submit" class="btn btn-contenido"><strong>Ingresar</strong></button>
                </div>
                <div class="login-footer">
                    <div>
                        <span>¿Eres cliente y aún no tienes una cuenta?</span>
                    </div>
                    <div>
                        <a href="/registrarme"><span>Registrate</span></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection