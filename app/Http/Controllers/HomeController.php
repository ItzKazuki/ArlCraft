<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Video;
use App\Models\Voter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => 'Home'
        ]);
    }

    public function store()
    {
        return view('store', [
            'title' => 'Store'
        ]);
    }

    public function vote()
    {
        //get data from this web
        $getVoters = Http::get('https://minecraftpocket-servers.com/api/?object=servers&element=voters&key='. env('MC_POCKET_SERVER_KEY') .'&month=current&format=json&limit=1000')->json();

        $monthVoter = new Carbon('last day of last month'); //tanggal 1 di reverse ke bulan sebelumny.. ex hari ini bulan may sebelumby bakal return bulan april
        $carbonNow = Carbon::now(); //mendeklarasikan carbon now

        $modal = true;
        if ($carbonNow->format('d') > '05') {
            $modal = false;
        }

        $topVoter = Voter::where('month', '=', intval($monthVoter->format('m')))->get(); //mencari top voter berdasarkan month

        return view('vote', [
            'title' => 'Votes',
            'showModal' => $modal,
            'voters' => $getVoters['voters'],
            'countVoters' => count($getVoters['voters']),
            'monthVoter' => $monthVoter,
            'topVoter' => $topVoter
        ]);
    }

    public function event()
    {
        return view('events', [
            'title' => 'Events',
            'events' => Event::all()
        ]);
    }

    public function video()
    {
        return view('video', [
            'title' => 'Videos',
            'videos' => Video::all()
        ]);
    }

    public function link()
    {
        $link = [
            [
                'name' => 'wa1',
                'link' => 'https://blabalalbalbl.com'
            ],
            [
                'name' => 'wa2',
                'link' => 'https://blabalalbalbl.com'
            ],
            [
                'name' => 'wa3',
                'link' => 'https://blabalalbalbl.com'
            ],
            [
                'name' => 'wa4',
                'link' => 'https://blabalalbalbl.com'
            ],
            [
                'name' => 'wa5',
                'link' => 'https://blabalalbalbl.com'
            ],
            [
                'name' => 'wa6',
                'link' => 'https://blabalalbalbl.com'
            ],
        ];
        
        return view('link', [
            'title' => 'Link',
            'links' => $link
        ]);
    }
}
