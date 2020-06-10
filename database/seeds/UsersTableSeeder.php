<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@gmail.com')->first();
        if (!$user) {
            User::create([
                'role' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => '2020-06-10 07:06:21',
                'password' => Hash::make('123456')
            ]);
            User::create([
                'role' => 'student',
                'name' => 'Student',
                'email' => 'student@gmail.com',
                'email_verified_at' => '2020-06-10 07:06:21',
                'password' => Hash::make('123456')
            ]);
        }
    }
}
