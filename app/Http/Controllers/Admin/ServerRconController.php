<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannedUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServerRconController extends Controller
{
    public function sendRcon($cmd)
    {
        // $response = array();
        $rcon = $this->rconConnection();

        if ($rcon->connect()) {
            $rcon->sendCommand($cmd);
            // $response['status'] = 'success';
            // $response['command'] = $cmd;
            // $response['response'] = $rcon->get_response();

            return true;
        } else {
            // $response['status'] = 'error';
            // $response['error'] = 'RCON connection error';

            return false;
        }
    }

    public function ban() 
    {
        return view('admin.server.ban', [
            'title' => 'Ban Members',
            'bans' => BannedUser::all()
        ]);
    }

    public function banStore(Request $request) 
    {
        $cmd = 'ban' . ' ' . $request->player . ' ' . $request->durasi . ' ' . $request->message;
        if(BannedUser::where('username', $request->player)->first() != null) {
            return redirect()->back()->with('error', 'this username already banned');
        }

        //set to database
        BannedUser::create([
            'username' => $request->player,
            'duration' => $request->durasi,
            'message' => $request->message,
            'banned_by' => Auth::user()->username
        ]);

        $status = $this->sendRcon($cmd);

        if (!$status) {
            return redirect()->back()->with('error', 'RCON connection error');
        }

        return redirect()->back()->with('success', 'Success send request');
    }

    public function sendCommand()
    {
        return view('admin.server.command', [
            'title' => 'Send Command'
        ]);
    }

    public function sendCommandStore(Request $request)
    {
        $cmd = '';
        $this->sendRcon($cmd);
    }

    public function setRanks()
    {
        return view('admin.server.ranks', [
            'title' => 'Set Member Ranks'
        ]);
    }

    public function sendRanksStore(Request $request)
    {
        $cmd = '';
        $this->sendRcon($cmd);
    }
}
