<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultAccountsSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $accounts = [
            ['name' => 'admin',      'email' => 'admin@gmail.com',      'type' => 'admin',      'role' => 'head'],
            ['name' => 'registrar',  'email' => 'registrar@gmail.com',  'type' => 'registrar',  'role' => 'head'],
            ['name' => 'accounting', 'email' => 'accounting@gmail.com', 'type' => 'accounting', 'role' => 'head'],
            ['name' => 'admission',  'email' => 'admission@gmail.com',  'type' => 'admission',  'role' => 'head'],
        ];

        foreach ($accounts as $account) {
            User::firstOrCreate(
                ['email' => $account['email']],
                $account + ['password' => bcrypt('password')]
            );
        }
    }
}
