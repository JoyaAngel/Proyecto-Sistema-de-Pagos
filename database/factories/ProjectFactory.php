<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

        $subtotal = $this->faker->randomFloat(2, 10000, 999999);
        $tax = 0.16;
        $total = $subtotal + ($subtotal * $tax);


        return [
            'client_id' => Client::inRandomOrder()->first()->id,

            // Otros campos
            'name' => $this->faker->word(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'concept' => $this->faker->randomElement(['concepto 1', 'concepto 2', 'concepto 3']),
            'status' => $this->faker->randomElement(['a', 'i', 'f']),
            'comments' => $this->faker->sentence(),
        ];
    }
}
