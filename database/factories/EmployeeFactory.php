<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Ramsey\Uuid\Uuid;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => Uuid::uuid4()->toString(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'company_id' => Company::all(['id'])->random(),
        ];
    }
}
