<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name'     => '超管',
            'email'    => 'zhangjuan',
            'password' => bcrypt('123456'),
        ]);
    }
}
