<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'username' => 'admin_' . Str::random(5),
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Customer user
        User::create([
            'name' => 'John Doe',
            'username' => 'customer_' . Str::random(5),
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);
    }
}
