<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use App\Models\ProjectSupplier;
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
        $transaction = Transaction::factory()->create();
        $projectSupplier = ProjectSupplier::inRandomOrder()->first();
        return [
            'transaction_id' => $transaction->id,
            'project_supplier_id' => $projectSupplier->id,
        ];
    }
}
