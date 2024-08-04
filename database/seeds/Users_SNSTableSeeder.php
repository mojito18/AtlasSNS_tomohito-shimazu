<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class Users_SNSTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['username' => 'tommy john','mail' => 'atlas5@ezezweb.ne.jp','password' => Hash::make
('plain_password')]
        ]);
    }
}
