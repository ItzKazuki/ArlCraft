<?php

namespace App\Http\Controllers\Api;

use xPaw\MinecraftQuery;
use xPaw\MinecraftPing;
use Illuminate\Http\Request;
use xPaw\MinecraftQueryException;
use xPaw\MinecraftPingException;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Thedudeguy\Rcon;

class ApiMinecraftController extends Controller
{
    public function index()
    {
        return view('api.index', [
            'title' => 'API'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Request $request
     */
    public function bedrock(Request $request)
    {
        $query = new MinecraftQuery();

        if (!$request->ip || !$request->port) {
            $data = [
                'status' => 400,
                'error' => 'tidak ada parameter',
                'penyelesaian' => 'url harus berisi parameter ip dan port.. ex /server/bedrock?ip=yourip&port=yourport'
            ];
            return $data;
        }
        
        try {

            $query->ConnectBedrock($request->ip, $request->port);

            return [
                'status' => 200,
                'data' => $query->GetInfo()
            ];
        } catch( MinecraftQueryException $e ) {
            return [
                'error' => $e->getMessage( )
            ];
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Request $request
     */
    public function java(Request $request)
    {
        $query = new MinecraftQuery();

        if (!$request->ip || !$request->port) {
            $data = [
                'status' => 400,
                'error' => 'tidak ada parameter',
                'penyelesaian' => 'url harus berisi parameter ip dan port.. ex /server/java?ip=yourip&port=yourport'
            ];
            return $data;
        }

        try {

            $query->Connect($request->ip, $request->port);

            return [
                'status' => 200,
                'data' => $query->GetInfo(),
                'players' => $query->GetPlayers()
            ];
        } catch( MinecraftPingException $e ) {
            return [
                'error' => $e->getMessage( )
            ];
        }
    }

    public function voter(Request $request)
    {
        if (!$request->key) {
            $data = [
                'status' => 400,
                'error' => 'tidak ada ServerKey',
                'penyelesaian' => 'url harus berisi parameter key untuk memvalidasi data yang di minta.. *note: limit hanya max hingga 1000 ex: /api/voters?key=yourkey&limit=limit'
            ];
            return $data;
        }

        $data = [
            'key' => $request->key,
            'limit' => 100
        ];
        
        if(isset($request->limit)) {
            $data['limit'] = intval($request->limit);
        };

        $result = $this->curl('https://minecraftpocket-servers.com/api/?object=servers&element=voters&key='. $data['key'] .'&month=current&format=json$limit='. $data['limit']);

        return json_decode($result);
    }

    public function rcon()
    {
        return view('api.rcon');
    }

    public function rconPost(Request $request)
    {
        $host = $request->host;
        $port = $request->port;
        $password = $request->password;
        $timeout = 3;

        $response = array();
        $rcon = new Rcon($host, $port, $password, $timeout);

        if ($rcon->connect()) {
            $rcon->sendCommand($request->cmd);
            $response['status'] = 'success';
            $response['command'] = $request->cmd;
            $response['response'] = $this->parseMinecraftColors($rcon->getResponse());
        }
        else {
            $response['status'] = 'error';
            $response['error'] = 'RCON connection error';
        }

        return json_encode($response);
    }

    public function parseMinecraftColors($string)
    {
        $string = utf8_decode(htmlspecialchars($string, ENT_QUOTES, "UTF-8"));
        $string = preg_replace('/\xA7([0-9a-f])/i', '<span class="mc-color mc-$1">', $string, -1, $count) . str_repeat("</span>", $count);
        return utf8_encode(preg_replace('/\xA7([k-or])/i', '<span class="mc-$1">', $string, -1, $count) . str_repeat("</span>", $count));
    }
}
