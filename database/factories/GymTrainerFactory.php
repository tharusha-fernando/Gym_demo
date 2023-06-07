<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GymTrainer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymTrainer>
 */
class GymTrainerFactory extends Factory
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

        $gymTrainers = User::whereHas('roles', function ($query) {
            $query->where('name', 'gym_trainer');
        })->get();

        return [
            'user_id'=>$gymTrainers->random()->id,
            //
        ];
    }
}
