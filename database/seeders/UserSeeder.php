<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vader = DB::table('users')->insert([
            'name'   => 'Kazuki',
            'username'   => 'kazuki',
            'email'      => 'ibnu235729@gmail.com',
            'password'   => Hash::make('thedarkside'),
            'isAdmin' => true,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('users')->insert([
            'name' => 'GoodIsec',
            'username'   => 'goodsidesoldier',
            'email'      => 'lightwalker@rebels.com',
            'password'   => Hash::make('hesnotmydad'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('users')->insert([
            'name' => 'Gomena',
            'username'   => 'greendemon',
            'email'      => 'dancingsmallman@rebels.com',
            'password'   => Hash::make('yodaIam'),
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
}
