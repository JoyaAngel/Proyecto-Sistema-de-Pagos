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
        $project = Project::inRandomOrder()->first();

        $remainingBudget = $project->total - $project->advances()->with('transaction')->get()->sum('transaction.amount');

        // Ensure the transaction amount does not exceed the remaining budget
        $transactionAmount = $this->faker->numberBetween(1, max(1, (int)($remainingBudget * 0.5)));

        $transaction = Transaction::factory()->create([
            'amount' => min($transactionAmount, $remainingBudget),
        ]);

        return [
            'transaction_id' => $transaction->id,
            'project_id' => $project->id,
        ];
    }
}