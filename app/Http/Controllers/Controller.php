<?php

namespace App\Http\Controllers;

use linslin\yii2\curl;
use Thedudeguy\Rcon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function curl($url) 
    {
        $curl = new curl\Curl();
        return json_decode($curl->get($url));
    }

    public function rconConnection()
    {
        $host = env('MINECRAFT_SERVER_IP');
        $port = env('MINECRAFT_SERVER_RCON_PORT');
        $password = env('MINECRAFT_SERVER_RCON_PASSWORD');

        $rcon = new Rcon($host, $port, $password, 3);
        return $rcon;
    }
}
