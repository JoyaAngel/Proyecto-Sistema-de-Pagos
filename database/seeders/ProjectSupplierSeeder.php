<?php

namespace Database\Seeders;

use App\Models\ProjectSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectSupplier::factory()->count(50)->create();
    }
}
