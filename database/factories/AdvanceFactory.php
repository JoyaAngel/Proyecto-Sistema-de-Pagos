<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Advance;
use App\Models\Transaction;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdvanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaction = Transaction::factory()->create();
        $project = Project::inRandomOrder()->first();
        return [
            'transaction_id' => $transaction->id,
            'project_id' => $project->id,
        ];
    }
}
