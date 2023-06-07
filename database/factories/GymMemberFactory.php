<?php

namespace Database\Factories;

use App\Models\GymOwner;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GymMember>
 */
class GymMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gymOwners = GymOwner::all();

        $gymMember = User::whereHas('roles', function ($query) {
            $query->where('name', 'gym_member');
        })->get();

        return [
            'gym_owner_id' => $gymOwners->random()->id,
            'user_id'=>$gymMember->random()->id,
        ];
    }
}
