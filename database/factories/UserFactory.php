<?php

// database/factories/UserFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;

class UserFactory extends Factory {
    protected $model = \App\Models\User::class;

    public function definition(): array {
        $role = Role::inRandomOrder()->first()->id;
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'role_id' => $role,
        ];
    }
}