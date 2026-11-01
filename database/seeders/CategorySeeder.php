<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Events', 'Notices', 'Emergency', 'Maintenance'] as $name) {
            \App\Models\Category::firstOrCreate(['name' => $name]);
        }
    }
}
