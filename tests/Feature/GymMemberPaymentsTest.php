<?php

namespace Tests\Feature;

use App\Models\GymMember;
use App\Models\GymOwner;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymMemberPaymentsTest extends TestCase
{

    use RefreshDatabase;

    
    public $admin, $gym_owner, $gym_member, $gym_trainer;
    /**
     * A basic feature test example.
     *  public function test_example(): void
     *{
     *   $response = $this->get('/');

     * $response->assertStatus(200);
     *}
     */

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->admin = User::factory()->create();
        $this->admin->addRole('administrator');

       


        $this->gym_owner = User::factory()->create();
        $this->gym_owner->addRole('gym_owner');
        $gymOwnerData = GymOwner::factory()->create(['user_id' => $this->gym_owner->id]);

        $this->gym_member = User::factory()->create();
        $this->gym_member->addRole('gym_member');
        $gymMemberData = GymMember::factory()->create(['user_id' => $this->gym_member->id]);


        $this->gym_trainer = User::factory()->create();
        $this->gym_trainer->addRole('gym_trainer');
        //$gymTrainerData = GymTrainer::factory()->hasGymOwner(1,['gym_name'=>$gymOwnerData->gym_name])->create(['user_id' => $this->gym_owner->id]);
    }


    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    
}
