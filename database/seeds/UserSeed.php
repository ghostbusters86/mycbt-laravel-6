<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'user 1',
            'email' => 'user@user.com',
            'password' => bcrypt('user1234'),
            'jenis_kelamin' => 'L'
        ]);

        User::create([
            'name' => 'user 2',
            'email' => 'user2@user.com',
            'password' => bcrypt('user1234'),
            'jenis_kelamin' => 'P'
        ]);
    }
}
