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
            'email'    => 'root@root.com',
            'password' => bcrypt('root123'),
        ]);
    }
}
