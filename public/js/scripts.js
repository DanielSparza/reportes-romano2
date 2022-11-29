// CODIGO PARA TABLAS RESPONSIVAS
$(document).ready(function () {
    $('#tabla-lista-reportes').DataTable({
        ordering: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

$(document).ready(function () {
    $('#tabla-lista-clientes').DataTable({
        searching: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

$(document).ready(function () {
    $('#tabla-lista-comunidades').DataTable({
        searching: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

$(document).ready(function () {
    $('#tabla-administrar-contenido').DataTable({
        searching: false,
        ordering: false,
        info: false,
        paging: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

$(document).ready(function () {
    $('#tabla-lista-paquetes').DataTable({
        searching: false,
        lengthMenu: [
            [5, 10, -1],
            [5, 10, 'Todos'],
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

$(document).ready(function () {
    $('#tabla-contacto').DataTable({
        searching: false,
        paging: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

$(document).ready(function () {
    $('#tabla-sobre-nosotros').DataTable({
        searching: false,
        ordering: false,
        info: false,
        paging: false,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros.",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Cantidad de registros: _MENU_ ",
            "loadingRecords": "Cargando...",
            "processing": "",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron coincidencias.",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar columna ascendente.",
                "sortDescending": ": activar para ordenar la columna descendente."
            }
        }
    });
});

// $('#tabla-lista-reportes').DataTable( {
//     responsive: true
// } );    

/* METODO PARA OCULTAR Y MOSTRAR EL MENU LATERAL */
// function mostrarmenu() {
//     var botonMenu = document.getElementById("btn-menu");
//     if (botonMenu.checked == true) {
//         document.getElementById("menu_lateral").classList.add("mostrar");
//         document.getElementById("menu_lateral").classList.add("desplazar");
//         document.getElementById("menu_options").classList.add("desplazar");
//     } else {
//         document.getElementById("menu_lateral").classList.remove("mostrar");
//         document.getElementById("menu_lateral").classList.remove("desplazar");
//         document.getElementById("menu_options").classList.remove("desplazar");
//     }
// }

/* CODIGO PARA Swiper JS*/
// var swiper = new Swiper(".mySwiper", {

//     spaceBetween: 30,
//     freeMode: true,
//     navigation: {
//         nextEl: ".swiper-button-next",
//         prevEl: ".swiper-button-prev",
//     },
// });

var swiper = new Swiper(".swiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },

    breakpoints: {
        620: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        680: {
            slidesPerView: 2,
            spaceBetween: 40,
        },
        920: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
        1240: {
            slidesPerView: 3,
            spaceBetween: 45,
        }
    }
});

/* MÉTODO PARA OCULTAR Y MOSTRAR LAS TABLAS DE LA SECCIÓN DE ADMINISTRACIÓN DE PÁGINA WEB*/
// var botonCabecera = document.getElementById("btn-cabecera");
// botonCabecera.addEventListener("click", mostrarCabecera);

// var botonCabecera = document.getElementById("btn-cabecera");
// botonCabecera.addEventListener("click", mostrarCabecera);

// function mostrarCabecera() {
//     document.getElementById("cabecera").classList.add("mostrar-tabla");
//     document.getElementById("menu_lateral").classList.add("desplazar");
//     document.getElementById("menu_options").classList.add("desplazar");
// }

var listaBotones = document.getElementById("botones-secciones");

if (listaBotones) {
    listaBotones.addEventListener('click', (e) => {
        if (e.target && (e.target.tagName === 'BUTTON' || e.target.tagName === 'STRONG')) {
            if (e.target.id === 'btn-cabecera' || e.target.id === 'str-cabecera') {
                document.getElementById("contacto").setAttribute('hidden', true);
                document.getElementById("paquetes").setAttribute('hidden', true);
                document.getElementById("sobre-nosotros").setAttribute('hidden', true);
                document.getElementById("cabecera").removeAttribute('hidden');
            }
            if (e.target.id === 'btn-sobre-nosotros' || e.target.id === 'str-sobre-nosotros') {
                document.getElementById("contacto").setAttribute('hidden', true);
                document.getElementById("paquetes").setAttribute('hidden', true);
                document.getElementById("cabecera").setAttribute('hidden', true);
                document.getElementById("sobre-nosotros").removeAttribute('hidden');
            }
            if (e.target.id === 'btn-paquetes' || e.target.id === 'str-paquetes') {
                document.getElementById("contacto").setAttribute('hidden', true);
                document.getElementById("cabecera").setAttribute('hidden', true);
                document.getElementById("sobre-nosotros").setAttribute('hidden', true);
                document.getElementById("paquetes").removeAttribute('hidden');
            }
            if (e.target.id === 'btn-contacto' || e.target.id === 'str-contacto') {
                document.getElementById("cabecera").setAttribute('hidden', true);
                document.getElementById("sobre-nosotros").setAttribute('hidden', true);
                document.getElementById("paquetes").setAttribute('hidden', true);
                document.getElementById("contacto").removeAttribute('hidden');
            }
        }
    });
}

//MOSTRAR Y OCULTAR MENÚ LATERAL

/*function mostrarmenu() {
    const $botonMenu = document.getElementById("btn-menu");
    if ($botonMenu.checked == true) {
        document.getElementById("menu-lateral").classList.add("mostrar");
        document.getElementById("menu-lateral").classList.add("desplazar");
        document.getElementById("menu_options").classList.add("desplazar");
    } else {
        document.getElementById("menu-lateral").classList.remove("mostrar");
        document.getElementById("menu-lateral").classList.remove("desplazar");
        document.getElementById("menu_options").classList.remove("desplazar");
    }
}*/

const $botonMenu = document.getElementById("btn-menu");
const $aside = document.getElementById("menu-lateral");
const $fondo = document.getElementById("fondo-menu");
const $cuerpo = document.getElementById("body");

$botonMenu.addEventListener("click", () => {
    $fondo.classList.toggle("mostrar-fondo");
    $aside.classList.toggle("desplegar")
    /*$cuerpo.classList.toggle("ocultar-scroll");*/
})

/*---------------------- FUNCIÓN PARA DISPARAR ALERTAS ----------------------*/
const $btnAlerta = document.getElementById("btn-alert");

function dispararAlerta() {
    if ($btnAlerta) {
        $btnAlerta.click();
    }
}

/*---------------------- FUNCION PARA BUSQUEDA RAPIDA DE TABLAS ------------*/

$(document).ready(function () {
    $("#admin-buscar-usuario").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tabla-usuarios-admin tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function () {
    $("#admin-buscar-cliente").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tabla-clientes-admin tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function () {
    $("#reportes-buscar-cliente").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tabla-clientes-reportes tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(document).ready(function () {
    $("#historial-buscar-reporte").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tabla-historial-reportes tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});


/*---------------------- FUNCION PARA VALIDAR QUE LA CONFIRMACIÓN DE CONTRASEÑA COINCIDA ------------*/
const formulario = document.getElementById("formulario-usuarios");

if (formulario) {
    const inputs = document.querySelectorAll("#formulario-usuarios input");

    inputs.forEach((input) => {
        input.addEventListener('keyup', (e) => {
            if (e.target.type === 'password') {
                if (validarContrasenas('formulario-usuarios', 'contrasena-add', 'confirmar-contrasena-add')) {
                    document.getElementById("btn-save-user").removeAttribute('disabled');
                } else {
                    document.getElementById("btn-save-user").setAttribute('disabled', true);
                }
            }
        })
    });
}

function validarContrasenas($formulario, $contraseña, $confirmarContraseña) {
    var pass1 = document.getElementById($contraseña).value;
    var pass2 = document.getElementById($confirmarContraseña).value;

    if (pass1.trim().length > 0) {
        if (pass1 === pass2) {
            document.querySelector('#' + $formulario + ' .form-password-match-error').classList.remove('form-password-match-error-active');
            return true;
        } else {
            document.querySelector('#' + $formulario + ' .form-password-match-error').classList.add('form-password-match-error-active');
            return false;
        }
    } else {
        document.querySelector('#' + $formulario + ' .form-password-match-error').classList.add('form-password-match-error-active');
        return false;
    }
}

// FUNCIÓN PARA MOSTRAR Y OCULTAR EL ICONO DE BORRADO DE LOS INPUTS DE BUSQUEDA
const filtrarUsuarios = document.getElementById('admin-buscar-usuario');

if (filtrarUsuarios) {
    filtrarUsuarios.addEventListener('keyup', (e) => {
        if (e.target.value.trim().length > 0) {
            const icon = document.getElementById('icono-borrar-usuarios');
            icon.classList.add('icon-clean-input-active');

            icon.addEventListener(('click'), () => {
                filtrarUsuarios.value = null;
                icon.classList.remove('icon-clean-input-active');

                const inputUser = document.getElementById('admin-buscar-usuario');

                //EVENTO KEY UP PARA QUESE MUESTREN TODOS LOS DATOS DE LA TABLA UNA VEZ QUE SE HA BORRADO EL CONTENIDO DEL INPUT
                //ESTE EVENTO EJECUTA LA FUNCIÓN DE JQUERY QUE DETECTA EL EVENTO KEY UP Y FILTRA LOS RESULTADOS DE LA TABLA
                const miEvento = new Event("keyup", {
                    bubbles: true,
                    cancelable: true,
                    viewArg: window,
                    ctrlKeyArg: false,
                    altKeyArg: false,
                    shiftKeyArg: false,
                    metaKeyArg: false,
                    keyCodeArg: 40, // keyCodeArg : unsigned long the virtual key code, else 0
                    charCodeArgs: 0 // charCodeArgs : unsigned long the Unicode character associated with the depressed key, else 0
                });

                inputUser.dispatchEvent(miEvento);
            })
        } else {
            document.getElementById('icono-borrar-usuarios').classList.remove('icon-clean-input-active');
        }
    })
}

const filtrarClientes = document.getElementById('admin-buscar-cliente');

if (filtrarClientes) {
    filtrarClientes.addEventListener('keyup', (e) => {
        if (e.target.value.trim().length > 0) {
            const icon = document.getElementById('icono-borrar-usuarios');
            icon.classList.add('icon-clean-input-active');

            icon.addEventListener(('click'), () => {
                filtrarClientes.value = null;
                filtrarClientes.focus();
                icon.classList.remove('icon-clean-input-active');

                const inputClient = document.getElementById('admin-buscar-cliente');

                //EVENTO KEY UP PARA QUESE MUESTREN TODOS LOS DATOS DE LA TABLA UNA VEZ QUE SE HA BORRADO EL CONTENIDO DEL INPUT
                //ESTE EVENTO EJECUTA LA FUNCIÓN DE JQUERY QUE DETECTA EL EVENTO KEY UP Y FILTRA LOS RESULTADOS DE LA TABLA
                const miEvento = new Event("keyup", {
                    bubbles: true,
                    cancelable: true,
                    viewArg: window,
                    ctrlKeyArg: false,
                    altKeyArg: false,
                    shiftKeyArg: false,
                    metaKeyArg: false,
                    keyCodeArg: 40, // keyCodeArg : unsigned long the virtual key code, else 0
                    charCodeArgs: 0 // charCodeArgs : unsigned long the Unicode character associated with the depressed key, else 0
                });

                inputClient.dispatchEvent(miEvento);
            })
        } else {
            document.getElementById('icono-borrar-usuarios').classList.remove('icon-clean-input-active');
        }
    })
}

const filtrarClientesreportes = document.getElementById('reportes-buscar-cliente');

if (filtrarClientesreportes) {
    filtrarClientesreportes.addEventListener('keyup', (e) => {
        if (e.target.value.trim().length > 0) {
            const icon = document.getElementById('icono-borrar-usuarios');
            icon.classList.add('icon-clean-input-active');

            icon.addEventListener(('click'), () => {
                filtrarClientesreportes.value = null;
                filtrarClientesreportes.focus();
                icon.classList.remove('icon-clean-input-active');

                const inputClient = document.getElementById('reportes-buscar-cliente');

                //EVENTO KEY UP PARA QUESE MUESTREN TODOS LOS DATOS DE LA TABLA UNA VEZ QUE SE HA BORRADO EL CONTENIDO DEL INPUT
                //ESTE EVENTO EJECUTA LA FUNCIÓN DE JQUERY QUE DETECTA EL EVENTO KEY UP Y FILTRA LOS RESULTADOS DE LA TABLA
                const miEvento = new Event("keyup", {
                    bubbles: true,
                    cancelable: true,
                    viewArg: window,
                    ctrlKeyArg: false,
                    altKeyArg: false,
                    shiftKeyArg: false,
                    metaKeyArg: false,
                    keyCodeArg: 40, // keyCodeArg : unsigned long the virtual key code, else 0
                    charCodeArgs: 0 // charCodeArgs : unsigned long the Unicode character associated with the depressed key, else 0
                });

                inputClient.dispatchEvent(miEvento);
            })
        } else {
            document.getElementById('icono-borrar-usuarios').classList.remove('icon-clean-input-active');
        }
    })
}

const filtrarHistorialreportes = document.getElementById('historial-buscar-reporte');

if (filtrarHistorialreportes) {
    filtrarHistorialreportes.addEventListener('keyup', (e) => {
        if (e.target.value.trim().length > 0) {
            const icon = document.getElementById('icono-borrar-usuarios');
            icon.classList.add('icon-clean-input-active');

            icon.addEventListener(('click'), () => {
                filtrarHistorialreportes.value = null;
                filtrarHistorialreportes.focus();
                icon.classList.remove('icon-clean-input-active');

                const inputReporte = document.getElementById('historial-buscar-reporte');

                //EVENTO KEY UP PARA QUESE MUESTREN TODOS LOS DATOS DE LA TABLA UNA VEZ QUE SE HA BORRADO EL CONTENIDO DEL INPUT
                //ESTE EVENTO EJECUTA LA FUNCIÓN DE JQUERY QUE DETECTA EL EVENTO KEY UP Y FILTRA LOS RESULTADOS DE LA TABLA
                const miEvento = new Event("keyup", {
                    bubbles: true,
                    cancelable: true,
                    viewArg: window,
                    ctrlKeyArg: false,
                    altKeyArg: false,
                    shiftKeyArg: false,
                    metaKeyArg: false,
                    keyCodeArg: 40, // keyCodeArg : unsigned long the virtual key code, else 0
                    charCodeArgs: 0 // charCodeArgs : unsigned long the Unicode character associated with the depressed key, else 0
                });

                inputReporte.dispatchEvent(miEvento);
            })
        } else {
            document.getElementById('icono-borrar-usuarios').classList.remove('icon-clean-input-active');
        }
    })
}

// FUNCIÓN PARA VALIDAR SI SE VA A CAMBIAR LA CONTRASEÑA
const cbxcontrasena = document.getElementById('cb-cambiar-contrasena');

if (cbxcontrasena) {
    cbxcontrasena.addEventListener('click', (e) => {
        if (e.target.checked == true) {
            document.getElementById("ipt-contrasena").setAttribute('required', true);
            document.getElementById("ipt-contrasena").setAttribute('minlength', "8");
            document.getElementById("ipt-contrasena").setAttribute('maxlength', "100");
            document.getElementById("ipt-confirmar-contrasena").setAttribute('required', true);
            document.getElementById("ipt-confirmar-contrasena").setAttribute('minlength', "8");
            document.getElementById("ipt-confirmar-contrasena").setAttribute('maxlength', "100");

            const formulario = document.getElementById("formulario-editar-usuarios");

            if (formulario) {
                const inputs = document.querySelectorAll("#formulario-editar-usuarios input");

                inputs.forEach((input) => {
                    input.addEventListener('keyup', (e) => {
                        if (e.target.type === 'password') {
                            if (validarContrasenas('formulario-editar-usuarios', 'ipt-contrasena', 'ipt-confirmar-contrasena')) {
                                document.getElementById("btn-edit-user").removeAttribute('disabled');
                            } else {
                                document.getElementById("btn-edit-user").setAttribute('disabled', true);
                            }
                        }
                    })
                });
            }
        } else {
            const iptpsswd = document.getElementById('ipt-contrasena');
            const iptpssdconf = document.getElementById('ipt-confirmar-contrasena');
            iptpsswd.removeAttribute('required');
            iptpsswd.removeAttribute('minlength');
            iptpsswd.removeAttribute('maxlength');
            iptpsswd.value = null;
            iptpssdconf.removeAttribute('required');
            iptpssdconf.removeAttribute('minlength');
            iptpssdconf.removeAttribute('maxlength');
            iptpssdconf.value = null;

            document.querySelector('#formulario-editar-usuarios' + ' .form-password-match-error').classList.remove('form-password-match-error-active');
            document.getElementById("btn-edit-user").removeAttribute('disabled');
        }
    })
}

//ACTIVAR Y DESACTIVAR BOTON PARA ENVIAT REPORTE EN MI CUENTA
var cbxEnviar = document.getElementById('cbx-enviar-reporte');
if (cbxEnviar) {
    var btnEnviar = document.getElementById('btn-enviar-reporte');
    cbxEnviar.addEventListener('click', (e) => {
        if (e.target.checked == true) {
            btnEnviar.removeAttribute('disabled');
        } else {
            btnEnviar.setAttribute('disabled', true);
        }
    })
}

//ENVIAR FORMULARIO DE REPORTE EN APARTADO MI CUENTA
var btnEnviarR = document.getElementById('btn-enviar-reporte');
if (btnEnviarR) {
    var btnSendR = document.getElementById('btn-send-report');
    btnEnviarR.addEventListener('click', (e) => {
        btnSendR.click();
        console.log('Se ha dado clic en el boton enviar formulario oculto.');
    })
}