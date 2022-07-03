<?php

use Illuminate\Database\Seeder;
use App\Admin as Admin;

class AdminsTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('users')->delete();

        Admin::create([
            'name' => 'آرش',
            'family' => 'آقاشاهی',
            'username' => 'samandar',
            'password' => bcrypt('samandar'),
            'email' => 'example@gmail.com'
        ]);
    }
}
