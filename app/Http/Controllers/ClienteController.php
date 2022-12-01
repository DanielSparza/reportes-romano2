<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    //
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        if (auth()->user()->fk_rol == 1) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $response1 = $this->client->request('GET', 'clientes', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $clientes = json_decode($response1->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response2->getBody()->getContents());

                    $response3 = $this->client->request('GET', 'mostrar-comunidades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidades = json_decode($response3->getBody()->getContents());

                    $response4 = $this->client->request('GET', 'paquetes-internet', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . config('app.app_id_key'),
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $paquetes = json_decode($response4->getBody()->getContents());

                    return view('/administrador/administrar-clientes', compact('clientes', 'ciudades', 'comunidades', 'paquetes'));
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function show($clave_ciudad)
    {
        //
        if (auth()->user()->fk_rol == 1 || auth()->user()->fk_rol == 2 || auth()->user()->fk_rol == 3) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    $response = $this->client->request('GET', 'comunidades-por-ciudad/' . $clave_ciudad, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidades = json_decode($response->getBody()->getContents());

                    return response()->json($comunidades);
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function showMiCuenta()
    {
        //
        $clave_usuario = auth()->user()->fk_clave_persona;

        if (auth()->user()->fk_rol == 4) {
            try {
                $token = session('token');

                $response = $this->client->request('GET', 'mi-cuenta/' . $clave_usuario, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $miCuenta = json_decode($response->getBody()->getContents());

                $response2 = $this->client->request('GET', 'reportes-activos/' . $clave_usuario, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $activos = json_decode($response2->getBody()->getContents());

                return view('/clientes/mi-cuenta', compact('miCuenta', 'activos'));
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function enviarReporte(Request $request)
    {
        if (auth()->user()->fk_rol == 4) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'fk_servicio' => ['required', 'numeric', 'integer'],
                        'problema' => ['required']
                    ]);

                    $vecesReportado = 1;
                    $reporto = auth()->user()->fk_clave_persona;
                    $fechaReporte = now()->isoFormat('YYYY-MM-DD');
                    $horaReporte = now()->isoFormat('H:mm:ss');
                    $estatus = 1;

                    $this->client->request('POST', 'levantar-reporte', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'fk_servicio' => $request->fk_servicio,
                            'problema' => $request->problema,
                            'veces_reportado' => $vecesReportado,
                            'reporto' => $reporto,
                            'fecha_reporte' => $fechaReporte,
                            'hora_reporte' => $horaReporte,
                            'estatus' => $estatus
                        ]
                    ]);

                    return redirect('/mi-cuenta')->with('message', 'Se ha registrado el reporte correctamente.');
                } else {
                    return redirect('/mi-cuenta')->withErrors('Servicio inactivo. No fue posible enviar el reporte, comuniquese a atención al cliente.');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para realizar esta acción.');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->fk_rol == 1) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'nombre' => ['required', 'max:100'],
                        'fk_ciudad' => ['required', 'numeric', 'integer'],
                        'telefono_movil' => ['required', 'max:20'],
                        'estatus' => ['required', 'numeric', 'integer', 'boolean'],
                        'direccion' => ['required', 'max:100'],
                        'nexterior' => ['required', 'max:10'],
                        'fk_comunidad' => ['required', 'numeric', 'integer'],
                        'estado' => ['required', 'max:30'],
                        'fk_paquete' => ['required', 'numeric', 'integer']
                    ]);

                    $nint = trim($request->ninterior);
                    if ($nint != null && strlen($nint) > 0) {
                        request()->validate([
                            'ninterior' => ['max:10']
                        ]);
                    }

                    $col = trim($request->colonia);
                    if ($col != null && strlen($col) > 0) {
                        request()->validate([
                            'colonia' => ['max:50']
                        ]);
                    }

                    $tel_fijo = trim($request->telefono_fijo);
                    if ($tel_fijo != null && strlen($tel_fijo) > 0) {
                        request()->validate([
                            'telefono_fijo' => ['max:50']
                        ]);
                    }

                    $lat = trim($request->latitud);
                    if ($lat != null && strlen($lat) > 0) {
                        request()->validate([
                            'latitud' => ['numeric']
                        ]);
                    }

                    $long = trim($request->longitud);
                    if ($long != null && strlen($long) > 0) {
                        request()->validate([
                            'longitud' => ['numeric']
                        ]);
                    }

                    $ruta_imagen = "";

                    if ($request->hasFile('foto_fachada')) {
                        request()->validate([
                            'foto_fachada' => ['image', 'max:1000']
                        ]);

                        $imagenes = $request->file('foto_fachada')->store('public/clientes');
                        $url = Storage::url($imagenes);

                        $ruta_imagen = $url;
                    }

                    $this->client->request('POST', 'clientes', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'nombre' => $request->nombre,
                            'fk_ciudad' => $request->fk_ciudad,
                            'telefono_movil' => $request->telefono_movil,
                            'estatus' => $request->estatus,
                            'direccion' => $request->direccion,
                            'nexterior' => $request->nexterior,
                            'ninterior' => $request->ninterior,
                            'colonia' => $request->colonia,
                            'fk_comunidad' => $request->fk_comunidad,
                            'estado' => $request->estado,
                            'telefono_fijo' => $request->telefono_fijo,
                            'fk_paquete' => $request->fk_paquete,
                            'latitud' => $request->latitud,
                            'longitud' => $request->longitud,
                            'foto_fachada' => $ruta_imagen
                        ]
                    ]);

                    return redirect('/administrar-clientes')->with('message', 'Se ha registrado el cliente correctamente.');
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function update(Request $request)
    {
        if (auth()->user()->fk_rol == 1) {
            try {
                $token = session('token');
                $responseE = $this->client->request('GET', 'validar-estatus/' . auth()->user()->fk_clave_persona, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $userEstatus = json_decode($responseE->getBody()->getContents());

                if ($userEstatus[0]->estatus == 1) {
                    request()->validate([
                        'nombre' => ['required', 'max:100'],
                        'fk_ciudad' => ['required', 'numeric', 'integer'],
                        'telefono_movil' => ['required', 'max:20'],
                        'estatus' => ['required', 'numeric', 'integer', 'boolean'],
                        'direccion' => ['required', 'max:100'],
                        'nexterior' => ['required', 'max:10'],
                        'fk_comunidad' => ['required', 'numeric', 'integer'],
                        'estado' => ['required', 'max:30'],
                        'fk_paquete' => ['required', 'numeric', 'integer'],
                        'clave_servicio' => ['required', 'numeric', 'integer']
                    ]);

                    $nint = trim($request->ninterior);
                    if ($nint != null && strlen($nint) > 0) {
                        request()->validate([
                            'ninterior' => ['max:10']
                        ]);
                    }

                    $col = trim($request->colonia);
                    if ($col != null && strlen($col) > 0) {
                        request()->validate([
                            'colonia' => ['max:50']
                        ]);
                    }

                    $tel_fijo = trim($request->telefono_fijo);
                    if ($tel_fijo != null && strlen($tel_fijo) > 0) {
                        request()->validate([
                            'telefono_fijo' => ['max:50']
                        ]);
                    }

                    $lat = trim($request->latitud);
                    if ($lat != null && strlen($lat) > 0) {
                        request()->validate([
                            'latitud' => ['numeric']
                        ]);
                    }

                    $long = trim($request->longitud);
                    if ($long != null && strlen($long) > 0) {
                        request()->validate([
                            'longitud' => ['numeric']
                        ]);
                    }

                    $ruta_imagen = "";

                    if ($request->hasFile('foto_fachada')) {
                        request()->validate([
                            'foto_fachada' => ['image', 'max:1000']
                        ]);

                        $oldimg = "";

                        if (strlen($request->foto_actual) > 9){
                            $oldimg = substr($request->foto_actual, 9);
                        }

                        Storage::delete('public/'.$oldimg);

                        $imagenes = $request->file('foto_fachada')->store('public/clientes');
                        $url = Storage::url($imagenes);

                        $ruta_imagen = $url;
                    }

                    $this->client->request('PUT', 'actualizar-cliente/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'nombre' => $request->nombre,
                            'fk_ciudad' => $request->fk_ciudad,
                            'telefono_movil' => $request->telefono_movil,
                            'estatus' => $request->estatus,
                            'direccion' => $request->direccion,
                            'nexterior' => $request->nexterior,
                            'ninterior' => $request->ninterior,
                            'colonia' => $request->colonia,
                            'fk_comunidad' => $request->fk_comunidad,
                            'estado' => $request->estado,
                            'telefono_fijo' => $request->telefono_fijo,
                            'fk_paquete' => $request->fk_paquete,
                            'latitud' => $request->latitud,
                            'longitud' => $request->longitud,
                            'foto_fachada' => $ruta_imagen,
                            'clave_servicio' => $request->clave_servicio
                        ]
                    ]);

                    return redirect('/administrar-clientes')->with('message', 'Se ha modificado el cliente ' . $request->id . ' correctamente.');
                } else {
                    return redirect('/logout');
                }
            } catch (RequestException $e) {
                if ($e->getCode() == 401) {
                    //SI SE RECIBE UN 405 SE RENUEVA EL TOKEN DE ACCESO
                    $renew = $this->client->request('POST', 'auth/refresh', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $newTonken = json_decode($renew->getBody()->getContents());
                    session(['token' => $newTonken->access_token]);

                    return redirect()->back();
                } else {
                    abort($e->getCode());
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }
}
