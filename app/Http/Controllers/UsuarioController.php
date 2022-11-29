<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class UsuarioController extends Controller
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
                    $response1 = $this->client->request('GET', 'usuarios', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $usuarios = json_decode($response1->getBody()->getContents());

                    $response2 = $this->client->request('GET', 'ciudades', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $ciudades = json_decode($response2->getBody()->getContents());

                    $response3 = $this->client->request('GET', 'roles', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                    ]);
                    $roles = json_decode($response3->getBody()->getContents());

                    return view('/administrador/administrar-usuarios', compact('usuarios', 'ciudades', 'roles'));
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
                        'usuario' => ['required', 'min:5', 'max:20', 'unique:App\Models\User,usuario,'],
                        'fk_rol' => ['required', 'numeric', 'integer'],
                        'estatus' => ['required', 'numeric', 'integer', 'boolean'],
                        'email' => ['required', 'email:rfc,dns', 'unique:App\Models\User,email,'],
                        'password' => ['required', 'min:8', 'max:100', 'confirmed']
                    ]);

                    $this->client->request('POST', 'usuarios', [
                        'headers' => [
                            'Authorization' => 'Bearer ' . config('app.app_id_key'),
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'nombre' => $request->nombre,
                            'fk_ciudad' => $request->fk_ciudad,
                            'telefono_movil' => $request->telefono_movil,
                            'usuario' => $request->usuario,
                            'fk_rol' => $request->fk_rol,
                            'estatus' => $request->estatus,
                            'email' => $request->email,
                            'password' => bcrypt($request->password)
                        ]
                    ]);

                    return redirect('/administrar-usuarios')->with('message', 'Se ha registrado el usuario correctamente.');
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
                        'id' => ['required', 'numeric', 'integer'],
                        'nombre' => ['required', 'max:100'],
                        'fk_ciudad' => ['required', 'numeric', 'integer'],
                        'telefono_movil' => ['required', 'max:20'],
                        'usuario' => ['required', 'min:5', 'max:20', 'unique:App\Models\User,usuario,' . $request->id],
                        'fk_rol' => ['required', 'numeric', 'integer'],
                        'estatus' => ['required', 'numeric', 'integer', 'boolean'],
                        'email' => ['required', 'email:rfc,dns', 'unique:App\Models\User,email,' . $request->id]
                    ]);

                    $psswd = trim($request->password);
                    if ($psswd != null && strlen($psswd) >= 0) {
                        request()->validate([
                            'password' => ['min:8', 'max:100', 'confirmed']
                        ]);

                        $psswd = bcrypt($request->password);
                    }

                    $this->client->request('PUT', 'actualizar-usuario/' . $request->id, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Accept' => 'application/json',
                        ],
                        'form_params' => [
                            'nombre' => $request->nombre,
                            'fk_ciudad' => $request->fk_ciudad,
                            'telefono_movil' => $request->telefono_movil,
                            'usuario' => $request->usuario,
                            'fk_rol' => $request->fk_rol,
                            'estatus' => $request->estatus,
                            'email' => $request->email,
                            'password' => $psswd
                        ]
                    ]);

                    return redirect('/administrar-usuarios')->with('message', 'Se ha modificado el usuario ' . $request->id . ' correctamente.');
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
