<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'wesley@contato.com.br')->first()) {
            $superAdmin = User::create([
                'name' => 'Wesley',
                'email' => 'wesley@contato.com.br',
                'password' => Hash::make('123456a', ['rouds' => 12]),
                //HASH (CRIPTOGRAFIA DA SENHA)
            ]);
        }
        if (!User::where('email', 'reis@contato.com.br')->first()) {
            $admin = User::create([
                'name' => 'Reis',
                'email' => 'reis@contato.com.br',
                'password' => Hash::make('123456a', ['rouds' => 12]),

            ]);
        }
        if (!User::where('email', 'oliveira@contato.com.br')->first()) {
            $teacher = User::create([
                'name' => 'Oliveira',
                'email' => 'oliveira@contato.com.br',
                'password' => Hash::make('123456a', ['rouds' => 12]),

            ]);
            if (!User::where('email', 'celke@contato.com.br')->first()) {
                $tutor = User::create([
                    'name' => 'Celke',
                    'email' => 'celke@contato.com.br',
                    'password' => Hash::make('123456a', ['rouds' => 12]),

                ]);
            }
        }
    }
}
