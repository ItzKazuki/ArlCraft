<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Voter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncTopVoterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'arlcraft:sync:topvoter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sync topvoter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $players = 5;
        $getVoters = Http::get('https://minecraftpocket-servers.com/api/?object=servers&element=voters&key='. env('MC_POCKET_SERVER_KEY') .'&month=previous&format=json&limit=' . $players)->json();
        $monthVoter = new Carbon('last day of last month');

        foreach ($getVoters['voters'] as $voter) {
            Voter::create([
                'nickname' => $voter['nickname'],
                'vote'     => $voter['votes'],
                'month'    => $monthVoter->format('m')
            ]);
        }

        return 0;
    }
}
