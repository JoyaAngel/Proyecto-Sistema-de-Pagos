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
        // seleccionar un cliente sin proyecto
        $client = Client::doesntHave('projects')->inRandomOrder()->first();

        $subtotal = $this->faker->randomFloat(2, 10000, 999999);
        $tax = 0.16;
        $total = $subtotal + ($subtotal * $tax);

        $startDate = $this->faker->date();
        $endDate = $this->faker->dateTimeBetween($startDate, '+2 years');
        if (now() >= $startDate && now() <= $endDate) {
            $status = 'a';
        } else {
            $status = $this->faker->randomElement(['i', 'f']);
        }


        return [
            'client_id' => $client->id,

            // Otros campos
            'name' => $this->faker->word(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'concept' => $this->faker->randomElement(['concepto 1', 'concepto 2', 'concepto 3']),
            'status' => $status,
            'comments' => $this->faker->sentence(),
        ];
    }
}
