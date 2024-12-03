<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\ProjectSupplier;
use App\Models\Payment;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $projectSupplier = ProjectSupplier::inRandomOrder()->first();

        $serviceCost = $projectSupplier->service_cost;

        $remainingBudget = $serviceCost - $projectSupplier->payments()->with('transaction')->get()->sum('transaction.amount');

        $transactionAmount = $this->faker->numberBetween(1, max(1, (int)($remainingBudget * 0.5)));

        $transaction = Transaction::factory()->create([
            'amount' => min($transactionAmount, $remainingBudget),
        ]);

        return [
            'transaction_id' => $transaction->id,
            'project_supplier_id' => $projectSupplier->id,
        ];

    }
}
