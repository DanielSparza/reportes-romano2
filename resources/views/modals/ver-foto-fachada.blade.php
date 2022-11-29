 <!-- MODAL PARA VER LA FACHADA DEL CLIENTE -->
 <div class="modal fade" id="view-facade-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title"><strong>Fachada del domicilio</strong></h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <img class="imagen-fachada" src='{!! asset("{$detalle->foto_fachada}") !!}' alt="Foto de la fachada del cliente">
             </div>
             <div class="modal-footer">
                 <a class="btn btn-reportar" data-dismiss="modal"> <strong>Cerrar</strong></a>
             </div>
         </div>
     </div>
 </div>