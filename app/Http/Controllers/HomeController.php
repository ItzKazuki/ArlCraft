<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\Video;
use App\Models\Voter;
use Illuminate\Http\Request;

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
        $url = 'https://minecraftpocket-servers.com/api/?object=servers&element=voters&key='. env('MC_POCKET_SERVER_KEY') .'&month=current&format=json&limit=1000';
        $data = $this->curl($url);

        $monthVoter = new Carbon('last day of last month'); //tanggal 1 di reverse ke bulan sebelumny.. ex hari ini bulan may sebelumby bakal return bulan april
        $carbonNow = Carbon::now(); //mendeklarasikan carbon now

        if ($data->month === $monthVoter->format('Ym')) {
            for ($i = 0; $i < 3; $i++) {
                //data->month top voter di bulan itu... monthvoter menyamakan top voter di bulan sebelumnya
                Voter::create([
                    'nickname' => $data->voters[$i]->nickname,
                    'vote'     => $data->voters[$i]->votes,
                    'month'    => $monthVoter->format('m')
                ]);
            }
        }

        $topVoter = Voter::where('month', intval($monthVoter->format('m')))->get(); //mencari top voter berdasarkan month
        $thisMonth = Carbon::createFromFormat('m', $monthVoter->format('m'))->format('F'); //mengubah integer month menjadi string month

        return view('vote', [
            'title' => 'Votes',
            'voters' => $data,
            'monthVoter' => $monthVoter->format('Ym'),
            'topVoter' => $topVoter,
            'thisMonth' => $thisMonth
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
