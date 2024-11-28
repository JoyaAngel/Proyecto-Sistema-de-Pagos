<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{

    protected $model = Transaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 100, 999999),
            'date' => $this->faker->date(),
            'payment_method' => $this->faker->randomElement(['cash', 'credit', 'debit', 'check']),
            'reference' => $this->faker->regexify('[A-Za-z0-9]{16}'),
        ];
    }
}
