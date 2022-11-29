<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//LOGIN Y REGISTRO
Route::get('/registrarme', 'App\Http\Controllers\RegisterController@show');
Route::post('/registrarme', 'App\Http\Controllers\RegisterController@register');
Route::get('/login', 'App\Http\Controllers\LoginController@show')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@iniciarSesion');

//LOGOUT
Route::get('/logout', 'App\Http\Controllers\LogoutController@logout')->middleware('auth');

//PAGINA PRINCIPAL
Route::get('/', 'App\Http\Controllers\IndexController@index');

//RUTAS PARA USUARIOS
Route::get('/administrar-usuarios', 'App\Http\Controllers\UsuarioController@index')->middleware('auth');
Route::post('/administrar-usuarios', 'App\Http\Controllers\UsuarioController@store')->middleware('auth');
Route::post('/administrar-usuarios/editar', 'App\Http\Controllers\UsuarioController@update')->middleware('auth');

//RUTAS PARA CLIENTES
Route::get('/administrar-clientes', 'App\Http\Controllers\ClienteController@index')->middleware('auth');
Route::post('/administrar-clientes', 'App\Http\Controllers\ClienteController@store')->middleware('auth');
Route::post('/administrar-clientes/editar', 'App\Http\Controllers\ClienteController@update')->middleware('auth');
Route::get('/administrar-clientes-comunidad/{clave_ciudad}',  'App\Http\Controllers\ClienteController@show')->middleware('auth');

//RUTAS PARA PAGINA WEB
Route::get('/administrar-pagina-web', 'App\Http\Controllers\PaginawebController@index')->middleware('auth');
Route::post('/administrar-pagina-web-paquete', 'App\Http\Controllers\PaginawebController@storePaquete')->middleware('auth');
Route::post('/administrar-pagina-web-paquete/editar', 'App\Http\Controllers\PaginawebController@updatePaquete')->middleware('auth');
Route::post('/administrar-pagina-web-cabecera/editar', 'App\Http\Controllers\PaginawebController@updateCabecera')->middleware('auth');
Route::post('/administrar-pagina-web-nosotros/editar', 'App\Http\Controllers\PaginawebController@updateNosotros')->middleware('auth');
Route::post('/administrar-pagina-web-contacto/editar', 'App\Http\Controllers\PaginawebController@updateContacto')->middleware('auth');

//RUTAS PARA COMUNIDADES Y CIUDADES
Route::get('/administrar-comunidades', 'App\Http\Controllers\ComunidadController@index')->middleware('auth');
Route::post('/administrar-ciudades', 'App\Http\Controllers\ComunidadController@storeCiudad')->middleware('auth');
Route::post('/administrar-ciudades/editar', 'App\Http\Controllers\ComunidadController@updateCiudad')->middleware('auth');
Route::post('/administrar-comunidades', 'App\Http\Controllers\ComunidadController@storeComunidad')->middleware('auth');
Route::post('/administrar-comunidades/editar', 'App\Http\Controllers\ComunidadController@updateComunidad')->middleware('auth');

//RUTAS PARA REPORTES
Route::get('/levantar-reportes', 'App\Http\Controllers\ReporteController@index')->middleware('auth');
Route::post('/levantar-reportes', 'App\Http\Controllers\ReporteController@store')->middleware('auth');
Route::get('/historial-reportes', 'App\Http\Controllers\ReporteController@indexHistorial')->middleware('auth');
Route::post('/historial-reportes', 'App\Http\Controllers\ReporteController@indexHistorialFilter')->middleware('auth');
Route::post('/historial-reportes-editar', 'App\Http\Controllers\ReporteController@updateProblema')->middleware('auth');
Route::post('/historial-reportes-aumentar', 'App\Http\Controllers\ReporteController@updateVeces')->middleware('auth');
Route::get('/reportes-pendientes', 'App\Http\Controllers\ReporteController@indexPendientes')->middleware('auth');
Route::post('/reportes-pendientes', 'App\Http\Controllers\ReporteController@indexPendientesFilter')->middleware('auth');
Route::get('/detalle-reporte-atender/{clave_reporte}', 'App\Http\Controllers\ReporteController@updateTecnico')->middleware('auth');
Route::get('/detalle-reporte/{clave_reporte}', 'App\Http\Controllers\ReporteController@showDetalle')->middleware('auth');
Route::post('/finalizar-reporte/{clave_reporte}', 'App\Http\Controllers\ReporteController@finalizarReporte')->middleware('auth');
Route::get('/mis-reportes', 'App\Http\Controllers\ReporteController@misReportes')->middleware('auth');
Route::post('/mis-reportes', 'App\Http\Controllers\ReporteController@misReportesFilter')->middleware('auth');

//ESTADISTICAS
Route::get('/estadisticas', 'App\Http\Controllers\ReporteController@showEstadisticas')->middleware('auth');
Route::post('/estadisticas', 'App\Http\Controllers\ReporteController@showEstadisticasFilter')->middleware('auth');

//MI CUENTA
Route::get('/mi-cuenta', 'App\Http\Controllers\ClienteController@showMiCuenta')->middleware('auth');
Route::post('/mi-cuenta', 'App\Http\Controllers\ClienteController@enviarReporte')->middleware('auth');