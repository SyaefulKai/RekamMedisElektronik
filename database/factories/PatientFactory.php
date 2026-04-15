<?php

namespace Database\Factories;

use App\Models\Resources\Patient;
use Illuminate\Database\Eloquent\Factories\Attributes\UseModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
#[UseModel(Patient::class)]
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        return [
            'medical_record_number' => $this->faker->randomNumber(6),
            'nik' => $this->faker->nik(),
            'name' => $this->faker->name($gender),
            'gender' => $gender,
            'birth_date' => $this->faker->dateTimeBetween('-30 years', '-20 years'),
            'address' => $this->faker->address()
        ];
    }
}
