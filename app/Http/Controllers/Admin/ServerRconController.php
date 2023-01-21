<?php

namespace App\Http\Controllers\Admin;

use App\Models\BannedUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ServerRconController extends Controller
{
    function parseMinecraftColors($string) {
      $string = utf8_decode(htmlspecialchars($string, ENT_QUOTES, "UTF-8"));
      $string = preg_replace('/\xA7([0-9a-f])/i', '<span class="mc-color mc-$1">', $string, -1, $count) . str_repeat("</span>", $count);
      return utf8_encode(preg_replace('/\xA7([k-or])/i', '<span class="mc-$1">', $string, -1, $count) . str_repeat("</span>", $count));
    }

    public function sendRcon($cmd)
    {
        // $response = array();
        $rcon = $this->rconConnection();

        if ($rcon->connect()) {
            $rcon->sendCommand($cmd);
            // $response['status'] = 'success';
            // $response['command'] = $cmd;
            // $response['response'] = $rcon->get_response();
            //dd($this->parseMinecraftColors($rcon->getResponse()));

            return $this->parseMinecraftColors($rcon->getResponse());
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
        $cmd = 'ban' . ' ' . $request->player . ' ' . $request->message;
        if(BannedUser::where('username', $request->player)->first() != null) {
            return redirect()->back()->with('error', 'this username already banned');
        }
        
        try {
            $status = $this->sendRcon($cmd);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        //set to database
        BannedUser::create([
            'username' => $request->player,
            'duration' => $request->durasi,
            'message' => $request->message,
            'banned_by' => Auth::user()->username
        ]);


        return redirect()->back()->with('success', $status);
    }

    public function sendCommand()
    {
        return view('admin.server.command', [
            'title' => 'Send Command'
        ]);
    }

    public function sendCommandStore(Request $request)
    {
        
        try {
            $status = $this->sendRcon($request->command);
        } catch (\Exception $e) {
            if(env('APP_ENV') == 'local') dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
        dd($status);

        return redirect()->back()->with('success', $status);
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
