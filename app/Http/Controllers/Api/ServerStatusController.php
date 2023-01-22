<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Thedudeguy\Rcon;
use xPaw\MinecraftQuery;

class ServerStatusController extends Controller
{
    public function statusServer()
    {
        $serverStats = $this->serverStatus();
        return [
            'server' => $serverStats,
            'rcon' => true
        ];
    }

    public function serverStatus()
    {
        try {
            $query = new MinecraftQuery();
            $query->ConnectBedrock(env('MINECRAFT_IP'), env('MINECRAFT_PORT'));
            
            if($query->GetInfo()) {
                return [
                    'status' => true,
                    'server' => 'online',
                    'player' => $query->GetInfo()['Players'],
                ];
            }
        } catch(\Exception $e) {
            return [
                'status' => false,
                'server' => 'offline',
                'message' => 'server closed, please wait a menutes',
                'error' => $e->getMessage()
            ];
        }
    }
}