<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class CompanyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'logo' => 'assets/images/placeholder.png'
        ];
    }
}
