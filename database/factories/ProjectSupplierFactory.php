<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProjectSupplier;
use Exception;

class ProjectSupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        // Obtiene una lista de combinaciones existentes
        $existingCombinations = ProjectSupplier::pluck('project_id', 'supplier_id')->toArray();

        // Selecciona un proyecto al azar
        $project = Project::inRandomOrder()->first();

        // Encuentra proveedores que no estén relacionados con el proyecto seleccionado
        $availableSuppliers = Supplier::whereNotIn('id', array_keys($existingCombinations))
            ->inRandomOrder()
            ->first();

        if (!$availableSuppliers) {
            throw new Exception('No hay combinaciones válidas de project_id y supplier_id disponibles.');
        }

        return [
            'project_id' => $project->id,
            'supplier_id' => $availableSuppliers->id,
            'service_cost' => $this->faker->randomFloat(2, 4999, 399999),
        ];
    }

}

