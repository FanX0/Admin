<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;

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
            'department_id' => Department::factory(),
            'position_id' => Position::factory(),
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'joined' => $this->faker->date(),
            'status' => $this->faker->word(),
        ];
    }
}
