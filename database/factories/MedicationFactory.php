<?php

namespace Database\Factories;

use App\Models\Resources\Medications\Medication;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'generic_name' => $this->faker->word(),
            'trade_name'   => $this->faker->company . ' ' . $this->faker->randomElement(['Tablet', 'Capsule', 'Syrup', 'Injection']),
            'form'         => $this->faker->randomElement(['tablet', 'capsule', 'syrup', 'injection', 'ointment']),
            'strength'     => $this->faker->randomFloat(2, 0.1, 500),
            'unit'         => $this->faker->randomElement(['mg', 'ml', 'g', 'µg']),
            'is_active'    => $this->faker->boolean,
        ];
    }
}
