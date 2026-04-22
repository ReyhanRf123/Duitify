<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SavingGoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();

            $user->savingGoals()->create([
                'name' => 'Upgrade Laptop Programming',
                'target_amount' => 15000000,
                'current_amount' => 2000000,
                'deadline' => now()->addMonths(10),
            ]);
    }
}
