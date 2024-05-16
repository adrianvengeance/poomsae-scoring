<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Juri 1', 'email' => 'juri1@mail.com', 'password' => Hash::make('password')],
            ['name' => 'Juri 2', 'email' => 'juri2@mail.com', 'password' => Hash::make('password')],
            ['name' => 'Juri 3', 'email' => 'juri3@mail.com', 'password' => Hash::make('password')],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
