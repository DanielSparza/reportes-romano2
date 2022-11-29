<!-- <div class="container alertas">
    <div class="alert alert-{{ $class }} alert-dismissible" data-dismiss="alert" role="alert">
        <em class="fa fa-lg fa-warning"></em>
        <strong>{{ $name }}</strong>
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div> -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#alert-modal" id="btn-alert" hidden></button>

<div class="container alerta {{ $class }}">
    <div class="modal fade" id="alert-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-center">
                    <h5 class="modal-title text-center"><em class="fa-lg {{ $icon }}"></em><strong>{{ $name }}</strong></h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <div class="modal-body cuerpo-modal">
                    <p>{{ $message }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-contenido" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>