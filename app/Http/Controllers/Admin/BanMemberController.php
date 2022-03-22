<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Rcon;
use GrahamCampbell\ResultType\Success;

class BanMemberController extends Controller
{
    public $host = 'nf1.fikq-host.xyz';
    protected $port = '2566';
    protected $password = 'BhPTpB1bvi';

    public function ban() 
    {
        return view('admin.ban.ban', [
            'title' => 'Ban Members'
        ]);
    }

    public function banStore(Request $request) 
    {
        $timeout = 3;
        $cmd = $request->command . ' ' . $request->player . ' ' . $request->durasi . ' ' . $request->message;

        // $response = array();
        $rcon = new Rcon($this->host, $this->port, $this->password, $timeout);

        if ($rcon->connect()) {
            $rcon->send_command($cmd);
            // $response['status'] = 'success';
            // $response['command'] = $cmd;
            // $response['response'] = $rcon->get_response();

            return redirect()->back()->with('success', 'Command berhasil di jalankan');
        } else {
            // $response['status'] = 'error';
            // $response['error'] = 'RCON connection error';

            return redirect()->back()->with('error', 'RCON connection error');
        }
    }

    public function banIp() 
    {
        return view('admin.ban.banIp', [
            'title' => 'Ban Ip Members'
        ]);
    }

    public function banIpStore(Request $request)
    {
        //
    }

}
