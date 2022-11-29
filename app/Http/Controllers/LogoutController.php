<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;

class LogoutController extends Controller
{
    //
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function logout()
    {
        try {
            $token = session('token');
            $this->client->request('POST', 'auth/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);

            Session::flush();
            Auth::logout();
            
            return redirect('/');
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
    }
}
