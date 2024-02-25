<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Enums\EmployeeStatus;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'department_id' => rand(1, 3),
            'position_id' => rand(1, 3),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'joined' => $this->faker->date(),
            'status' => collect(EmployeeStatus::cases())->random(),
        ];
    }
}
