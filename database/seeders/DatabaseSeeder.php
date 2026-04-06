<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Account;
use App\Models\Category;
use App\Models\SavingGoal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Utama
        $user = User::create([
            'name' => 'Reyhan Ribelfa',
            'email' => 'reyhan@duitify.test',
            'password' => Hash::make('password'),
        ]);

        $this->command->info('User berhasil dibuat.');

        // 2. Buat Accounts untuk User tersebut
        $accounts = [
            ['name' => 'Bank BCA', 'balance' => 5000000],
            ['name' => 'Dompet Tunai', 'balance' => 250000],
            ['name' => 'GoPay/Dana', 'balance' => 1000000],
        ];

        foreach ($accounts as $account) {
            $user->accounts()->create($account);
        }
        $this->command->info('Accounts berhasil dibuat.');

        // 3. Buat Categories
        $categories = [
            ['name' => 'Gaji/Kiriman', 'type' => 'income'],
            ['name' => 'Makanan & Minuman', 'type' => 'expense'],
            ['name' => 'Transportasi', 'type' => 'expense'],
            ['name' => 'Tabungan', 'type' => 'expense'],
        ];

        foreach ($categories as $category) {
            $user->categories()->create($category);
        }
        $this->command->info('Categories berhasil dibuat.');

        // 4. Buat Saving Goal
        $user->savingGoals()->create([
            'name' => 'Upgrade Laptop Programming',
            'target_amount' => 15000000,
            'current_amount' => 2000000,
            'deadline' => now()->addMonths(10),
        ]);
        $this->command->info('Saving Goal berhasil dibuat.');
    }
}