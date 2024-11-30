<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProjectSupplier;

class ProjectSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        do {
            $projectId = Project::inRandomOrder()->first()->id;
            $supplierId = Supplier::inRandomOrder()->first()->id;
        } while (ProjectSupplier::where('project_id', $projectId)
            ->where('supplier_id', $supplierId)
            ->exists()
        );
        return [
            'project_id' => $projectId,
            'supplier_id' => $supplierId,
            'service_cost' => $this->faker->randomFloat(2, 4999, 399999),
        ];
    }
}

