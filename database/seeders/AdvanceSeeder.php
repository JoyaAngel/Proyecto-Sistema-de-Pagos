<?php

namespace Database\Seeders;

use App\Models\Advance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advance::factory()->count(100)->create();
    }
}
