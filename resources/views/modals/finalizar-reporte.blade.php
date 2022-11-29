<!-- MODAL PARA FINALIZAR REPORTES Y AÑADIR LAS OBSERVACIONES -->
<div class="modal fade" id="end-report-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><strong>Finalizar Reporte {{$detalle->clave_reporte}}</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/finalizar-reporte/{{$detalle->clave_reporte}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label"><strong>Observaciones:</strong> </label>
                        <textarea rows="4" class="form-control" name="observaciones" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-finalizar"><strong>Finalizar</strong></button>
                </div>
            </form>
        </div>
    </div>
</div>