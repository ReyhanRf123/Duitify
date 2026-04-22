<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();

            $categories = [
                ['name' => 'Gaji/Kiriman', 'type' => 'income'],
                ['name' => 'Makanan & Minuman', 'type' => 'expense'],
                ['name' => 'Transportasi (Bensin/MRT)', 'type' => 'expense'],
                ['name' => 'Alat Tulis & Kuliah', 'type' => 'expense'],
                ['name' => 'Hiburan/Self-Reward', 'type' => 'expense'],
                ['name' => 'Tabungan', 'type' => 'expense'], // Kategori khusus untuk alokasi
            ];

            foreach ($categories as $category) {
                $user->categories()->create($category);
            }
    }
}
