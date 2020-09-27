<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        Admin::create([
            'email' => 'admin@admin.com',
            'name' => 'admin1234',
            'password' => bcrypt('admin12')
        ]);
    }
}
