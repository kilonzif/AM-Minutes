<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'David',
            'email' => 'david@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password')
        ]);
    }
}
