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
            'password' => bcrypt('user1234')
        ]);
    }
}
