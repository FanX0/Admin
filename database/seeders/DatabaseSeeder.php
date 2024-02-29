<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Farid Azhari',
            'email' => 'farid@test.com',
            'password' => bcrypt('farid123'),
            'email_verified_at' => now(),
        ]);

        collect([
            ['name' => 'IT', 'active' => true],
            ['name' => 'HR', 'active' => true],
            ['name' => 'Finance', 'active' => false],
        ])->each(fn ($item) => Department::create($item));

        collect([
            ['name' => 'Software Engineer'],
            ['name' => 'HR Manager'],
            ['name' => 'Finance Analyst'],
        ])->each(fn ($item) => Position::create($item));

        Employee::factory(20)->create();
    }
}
