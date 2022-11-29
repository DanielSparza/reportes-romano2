<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class IndexController extends Controller
{
    //
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        $response1 = $this->client->request('GET', 'datos-empresa', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('app.app_id_key'),
                'Accept' => 'application/json',
            ],
        ]);
        $datos = json_decode($response1->getBody()->getContents());

        $response2 = $this->client->request('GET', 'paquetes-internet', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('app.app_id_key'),
                'Accept' => 'application/json',
            ],
        ]);
        $paquetes = json_decode($response2->getBody()->getContents());

        return view('/index', compact('datos', 'paquetes'));
    }
}
