<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymOwner>
 */
class GymOwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gymOwners = User::whereHas('roles', function ($query) {
            $query->where('name', 'gym_owner');
        })->get();

        return [
            'gym_name' => $this->faker->company,
            'registration_number' => 'Reg Number',
            'user_id' => $gymOwners->random()->id,
        ];
    }
}
