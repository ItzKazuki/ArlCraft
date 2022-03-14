<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use DateTime;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('videos')->insert([
            'title' => 'Cara Join ArlCraft',
            'youtube_id'   => 'EJkwHCJlGqQ',
            'user_id'      => '11',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('videos')->insert([
            'title' => 'Q&A',
            'youtube_id'   => 'vNugaGvNPo0',
            'user_id'      => '12',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
