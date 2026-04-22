<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();

            $accounts = [
                ['name' => 'Bank BCA', 'balance' => 5000000],
                ['name' => 'Dompet Tunai', 'balance' => 250000],
                ['name' => 'GoPay/Dana', 'balance' => 1000000],
            ];

            foreach ($accounts as $account) {
                $user->accounts()->create($account);
            }
    }
}
