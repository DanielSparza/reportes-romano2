//MUESTRA LAS COMUNIDADES PERTENECIENTES A UNA CIUDAD EN EL MODAL AGREGAR CLIENTES
$("#select-ciudad").change(function (e) {
    if (e.target.value != null && e.target.value != "") {
        //OBTIENE LAS COMUNIDADES QUE PERTENECEN A UNA CIUDAD A TRAVES DE LA RUTA
        $.get("/administrar-clientes-comunidad/" + e.target.value + "", function (response) {
            $("#select-comunidad").empty(); //LIMPIA EL SELECT PARA QUE SOLO SE MUESTREN LAS COMUNIDADES AL SELECCIONAR UNA NUEVA CIUDAD
            for (i = 0; i < response.length; i++) {
                //CREA UN OPTION POR CADA REGISTRO QUE SE HAYA ENCONTRADO
                $("#select-comunidad").append("<option value='" + response[i].clave_comunidad + "'>" + response[i].comunidad + "</option>");
            }
        });
    }
});

//MUESTRA LAS COMUNIDADES PERTENECIENTES A UNA CIUDAD EN EL MODAL EDITAR CLIENTES
$("#select-ciudad-editar").change(function (e) {
    if (e.target.value != null && e.target.value != "") {
        //OBTIENE LAS COMUNIDADES QUE PERTENECEN A UNA CIUDAD A TRAVES DE LA RUTA
        $.get("/administrar-clientes-comunidad/" + e.target.value + "", function (response) {
            $("#select-comunidad-editar").empty(); //LIMPIA EL SELECT PARA QUE SOLO SE MUESTREN LAS COMUNIDADES AL SELECCIONAR UNA NUEVA CIUDAD
            for (i = 0; i < response.length; i++) {
                //CREA UN OPTION POR CADA REGISTRO QUE SE HAYA ENCONTRADO
                $("#select-comunidad-editar").append("<option value='" + response[i].clave_comunidad + "'>" + response[i].comunidad + "</option>");
            }
        });
    }
});

//MUESTRA LAS COMUNIDADES PERTENECIENTES A UNA CIUDAD EN LA VISTA REPORTES PENDIENTES
$("#select-ciudad-pendientes").change(function (e) {
    if (e.target.value != null && e.target.value != "") {
        //OBTIENE LAS COMUNIDADES QUE PERTENECEN A UNA CIUDAD A TRAVES DE LA RUTA
        $.get("/administrar-clientes-comunidad/" + e.target.value + "", function (response) {
            $("#select-comunidad-pendientes").empty(); //LIMPIA EL SELECT PARA QUE SOLO SE MUESTREN LAS COMUNIDADES AL SELECCIONAR UNA NUEVA CIUDAD
            $("#select-comunidad-pendientes").append("<option value='' disabled selected>Comunidad</option>");
            for (i = 0; i < response.length; i++) {
                //CREA UN OPTION POR CADA REGISTRO QUE SE HAYA ENCONTRADO

                //CONSIDERAR HACER UNA FUNCIÓN PARA QUE PERMITA VALIDAR CUAL OPTION DEBE ESTAR SELECCIONADO
                //-----------------------------------------------------------------------------------------//
                $("#select-comunidad-pendientes").append('<option {{ old("comunidad") == ' + response[i].clave_comunidad + ' ? "selected" : "" }} value="' + response[i].clave_comunidad + '">' + response[i].comunidad + '</option>');
            }
        });
    }
});

//SIMULA EN EVENTO CHANGE EN LOS ELEMENTOS SELECT PARA PRECARGAR LAS COMUNIDADES AUTOMATICAMENTE
function cargarComunidades($id_select) {
    const select = document.getElementById($id_select);

    const miEvento = new Event("change", {
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

    select.dispatchEvent(miEvento);
}