//----- CARGAR DATOS DE PAQUETES DE INTERNET -----
$('#admin-edit-paquetes').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var velocidad = button.data('vel')
  var costo = button.data('cos')
  var periodo = button.data('per')
  var descripcion = button.data('des')

  var modal = $(this)
  modal.find('.modal-title').text('Editar paquete ' + id)
  modal.find('.modal-body #input-velocidad').val(velocidad)
  modal.find('.modal-body #input-costo').val(costo)
  modal.find('.modal-body #input-periodo').val(periodo)
  modal.find('.modal-body #textarea-descripcion').val(descripcion)
  modal.find('.modal-body #input-id').val(id)
})

//----- CARGAR DATOS CIUDADES -----
$('#city-edit-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var ciudad = button.data('city')

  var modal = $(this)
  modal.find('.modal-title').text('Editar ciudad ' + id)
  modal.find('.modal-body #input-ciudad').val(ciudad)
  modal.find('.modal-body #input-id-ciudad').val(id)
})

//----- CARGAR DATOS COMUNIDADES -----
$('#community-edit-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var comunidad = button.data('comun')
  var ciudad = button.data('city')

  var modal = $(this)
  modal.find('.modal-title').text('Editar comunidad ' + id)
  modal.find('.modal-body #input-comunidad').val(comunidad)
  modal.find('.modal-body #input-id-comunidad').val(id)
  seleccionarOption('select-ciudad', ciudad);
})

//----- CARGAR DATOS USUARIOS -----
$('#user-edit-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nom')
  var ciudad = button.data('city')
  var telefono = button.data('tel')
  var user = button.data('usr')
  var email = button.data('mail')
  var rol = button.data('rol')
  var estatus = button.data('est')

  var modal = $(this)
  modal.find('.modal-title').text('Editar usuario ' + id)
  modal.find('.modal-body #input-id-usuario').val(id)
  modal.find('.modal-body #input-nombre').val(nombre)
  modal.find('.modal-body #input-telefono').val(telefono)
  modal.find('.modal-body #input-usuario').val(user)
  modal.find('.modal-body #input-email').val(email)
  seleccionarOption('select-ciudad', ciudad);
  seleccionarOption('select-rol', rol);
  seleccionarOption('select-estatus', estatus);
})

//----- CARGAR DATOS CLIENTES -----
$('#customer-edit-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nom')
  var direccion = button.data('dir')
  var nexterior = button.data('nex')
  var ninterior = button.data('nin')
  var colonia = button.data('col')
  var comunidad = button.data('com')
  var ciudad = button.data('city')
  var estado = button.data('estado')
  var fijo = button.data('fijo')
  var movil = button.data('mov')
  var estatus = button.data('est')
  var velocidad = button.data('vel')
  var latitud = button.data('lat')
  var longitud = button.data('lon')
  var foto = button.data('foto')
  var clave_servicio = button.data('cservicio')


  var modal = $(this)
  modal.find('.modal-title').text('Editar cliente ' + id)
  modal.find('.modal-body #input-id-cliente').val(id)
  modal.find('.modal-body #input-id-servicio').val(clave_servicio)
  modal.find('.modal-body #input-nombre').val(nombre)
  modal.find('.modal-body #input-direccion').val(direccion)
  modal.find('.modal-body #input-nexterior').val(nexterior)
  modal.find('.modal-body #input-ninterior').val(ninterior)
  modal.find('.modal-body #input-colonia').val(colonia)
  modal.find('.modal-body #input-estado').val(estado)
  modal.find('.modal-body #input-telfijo').val(fijo)
  modal.find('.modal-body #input-telmovil').val(movil)
  modal.find('.modal-body #input-latitud').val(latitud)
  modal.find('.modal-body #input-longitud').val(longitud)
  modal.find('.modal-body #input-foto-actual').val(foto)

  seleccionarOption('select-ciudad-editar', ciudad);
  seleccionarOption('select-estatus', estatus);
  seleccionarOption('select-paquete', velocidad);

  //PONE UNA PAUSA DE 5 SEGUNDOS PARA QUE SE PUEDAN CARGAR LA LISTA DE COMUNIDADES Y PODER SELECCIONAR LA QUE CORRESPONDE
  setTimeout(function () {
    seleccionarOption('select-comunidad-editar', comunidad);
  }, 5000);
})

//----- CARGAR DATOS CABECERA -----
$('#admin-edit-cabecera').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nombre = button.data('nom')
  var eslogan = button.data('esl')
  var imagen = button.data('img')

  var modal = $(this)
  modal.find('.modal-title').text('Editar cabecera')
  modal.find('.modal-body #input-id').val(id)
  modal.find('.modal-body #input-nombre').val(nombre)
  modal.find('.modal-body #input-eslogan').val(eslogan)
  modal.find('.modal-body #input-foto').val(imagen)
})

//----- CARGAR DATOS SOBRE NOSOTROS -----
$('#admin-edit-sobre-nosotros').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var nosotros = button.data('nos')

  var modal = $(this)
  modal.find('.modal-title').text('Editar contenido')
  modal.find('.modal-body #input-id').val(id)
  modal.find('.modal-body #txt-nosotros').val(nosotros)
})

//----- CARGAR DATOS CONTACTO -----
$('#admin-edit-contacto').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var direccion = button.data('dir')
  var ciudad = button.data('city')
  var telefono = button.data('tel')
  var email = button.data('mail')
  var facebook = button.data('face')
  var whatsapp = button.data('wht')

  var modal = $(this)
  modal.find('.modal-title').text('Editar datos de contacto')
  modal.find('.modal-body #input-id').val(id)
  modal.find('.modal-body #input-direccion').val(direccion)
  modal.find('.modal-body #input-ciudad').val(ciudad)
  modal.find('.modal-body #input-telefono').val(telefono)
  modal.find('.modal-body #input-correo').val(email)
  modal.find('.modal-body #input-facebook').val(facebook)
  modal.find('.modal-body #input-whatsapp').val(whatsapp)
})

//----- CARGAR DATOS CLIENTE REPORTES -----
$('#client-report-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var servicio = button.data('serv') // Extract info from data-* attributes
  var ciudad = button.data('city')
  var nombre = button.data('nom')
  var comunidad = button.data('com');

  var modal = $(this)
  modal.find('.modal-title').text('Levantar reporte')
  modal.find('.modal-body #input-clave-servicio').val(servicio)
  modal.find('.modal-body #lbl-cliente').text(nombre)
  modal.find('.modal-body #lbl-ciudad').text(ciudad)
  modal.find('.modal-body #lbl-comunidad').text(comunidad)
})

//----- CARGAR DATOS DETALLE HISTORIAL REPORTES -----
$('#view-report-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var cliente = button.data('cli')
  var ciudad = button.data('city')
  var comunidad = button.data('com')
  var direccion = button.data('dir')
  var nexterior = button.data('nex')
  var fechaReporte = button.data('fre')
  var horaReporte = button.data('hre')
  var fechaFinalizacion = button.data('ffi')
  var horaFinalizacion = button.data('hfi')
  var tecnico = button.data('tec')
  var reporto = button.data('rep')
  var problema = button.data('pro')
  var vecesReportado = button.data('vec')
  var observaciones = button.data('obs')

  var modal = $(this)
  modal.find('.modal-title').text('Detalle reporte ' + id)
  modal.find('.modal-body #lbl-cliente').text(cliente)
  modal.find('.modal-body #lbl-ciudad').text(ciudad)
  modal.find('.modal-body #lbl-comunidad').text(comunidad)
  modal.find('.modal-body #lbl-direccion').text(direccion)
  modal.find('.modal-body #lbl-nexterior').text(nexterior)
  modal.find('.modal-body #lbl-fechaReporte').text(fechaReporte)
  modal.find('.modal-body #lbl-horaReporte').text(horaReporte)
  modal.find('.modal-body #lbl-fechaFinalizacion').text(fechaFinalizacion)
  modal.find('.modal-body #lbl-horaFinalizacion').text(horaFinalizacion)
  modal.find('.modal-body #lbl-tecnico').text(tecnico)
  modal.find('.modal-body #lbl-reporto').text(reporto)
  modal.find('.modal-body #lbl-problema').text(problema)
  modal.find('.modal-body #lbl-vecesReportado').text(vecesReportado)
  modal.find('.modal-body #lbl-observaciones').text(observaciones)
})

//----- CARGAR DATOS EDITAR HISTORIAL REPORTES -----
$('#edit-report-modal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes
  var cliente = button.data('cli')
  var ciudad = button.data('city')
  var comunidad = button.data('com')
  var direccion = button.data('dir')
  var nexterior = button.data('nex')
  var problema = button.data('pro')

  var modal = $(this)
  modal.find('.modal-title').text('Editar reporte ' + id)
  modal.find('.modal-body #historial-clave-reporte').val(id)
  modal.find('.modal-body #lbl-editar-cliente').text(cliente)
  modal.find('.modal-body #lbl-editar-ciudad').text(ciudad)
  modal.find('.modal-body #lbl-editar-comunidad').text(comunidad)
  modal.find('.modal-body #lbl-editar-direccion').text(direccion)
  modal.find('.modal-body #lbl-editar-nexterior').text(nexterior)
  modal.find('.modal-body #txt-editar-problema').val(problema)
})

//----- CARGAR DATOS AUMENTAR VECES HISTORIAL REPORTES -----
$('#alert-modal-reportes').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var id = button.data('id') // Extract info from data-* attributes

  var modal = $(this)
  //modal.find('.modal-title').text('Editar reporte ' + id)
  modal.find('.modal-body #aumentar-clave-reporte').val(id);
  modal.find('.modal-body #p-mensaje').text('Se aumentará el número de veces reportado para el reporte ' + id + '. ¿Desea continuar?')
})

//----- FUNCIÓN PARA SELECCIONAR OPTION DE UN SELECT -----
function seleccionarOption($id, $valor) {
  var $controlSelect = document.getElementById($id);
  $controlSelect.value = $valor;
}