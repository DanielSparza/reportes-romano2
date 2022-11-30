<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ComunidadController extends Controller
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
                    $response1 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response1->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'obtener-comunidades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $comunidades = json_decode($response2->getBody()->getContents());

                    return view('/administrador/administrar-comunidades', compact('ciudades', 'comunidades'));
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
                    //abort($e->getCode());
                    return response($e);
                }
            }
        } else {
            return redirect('/')->withErrors('Acceso denegado. No tienes permiso para acceder a esta ruta.');
        }
    }

    public function storeCiudad(Request $request)
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
                        'ciudad' => ['required', 'max:50']
                    ]);

                    $this->client->request('POST', 'ciudades',  [
                        'headers' => [
                            'Authorization' => 'Bearer ' . config('app.app_id_key'),
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'ciudad' => $request->ciudad
                        ]
                    ]);

                    return redirect('/administrar-comunidades')->with('message', 'Se ha registrado la ciudad correctamente.');
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

    public function updateCiudad(Request $request)
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
                        'id' => ['required', 'numeric', 'integer'],
                        'ciudad' => ['required', 'max:50']
                    ]);

                    $this->client->request('PUT', 'actualizar-ciudad/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'ciudad' => $request->ciudad
                        ]
                    ]);

                    return redirect('/administrar-comunidades')->with('message', 'Se ha modificado la ciudad ' . $request->id . ' correctamente.');
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

    public function storeComunidad(Request $request)
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
                        'comunidad' => ['required', 'max:100'],
                        'fk_ciudad' => ['required', 'numeric', 'integer']
                    ]);

                    $this->client->request('POST', 'comunidades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'comunidad' => $request->comunidad,
                            'fk_ciudad' => $request->fk_ciudad
                        ]
                    ]);

                    return redirect('/administrar-comunidades')->throwResponse();
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

    public function updateComunidad(Request $request)
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
                        'id' => ['required', 'numeric', 'integer'],
                        'comunidad' => ['required', 'max:100'],
                        'fk_ciudad' => ['required', 'numeric', 'integer']
                    ]);

                    $this->client->request('PUT', 'actualizar-comunidad/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'comunidad' => $request->comunidad,
                            'fk_ciudad' => $request->fk_ciudad
                        ]
                    ]);

                    return redirect('/administrar-comunidades')->with('message', 'Se ha modificado la comunidad ' . $request->id . ' correctamente.');
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
