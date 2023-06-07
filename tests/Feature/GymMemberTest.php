<?php

namespace Tests\Feature;

use App\Models\GymMember;
use App\Models\GymOwner;
use App\Models\GymTrainer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymMemberTest extends TestCase
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
        $gymMemberData->GymOwner()->attach($gymOwnerData);


        $this->gym_trainer = User::factory()->create();
        $this->gym_trainer->addRole('gym_trainer');
        $gymTrainerData = GymTrainer::factory()->create(['user_id' => $this->gym_trainer->id]);
        $gymTrainerData->GymOwners()->attach($gymOwnerData);
    }





    public function test_create_gym_member_page_cant_render_without_auth()
    {
        $response = $this->get('/account-create/gym-member');
        $response->assertStatus(302);
    }

    public function test_create_gym_member_page_cant_access_by_gym_member()
    {
        $response = $this->actingAs($this->gym_member)->get('/account-create/gym-member');
        $response->assertStatus(403);
    }
    public function test_create_gym_member_page_can_access_by_gym_owner()
    {
        $response = $this->actingAs($this->gym_owner)->get('/account-create/gym-member');
        $response->assertStatus(200);
    }
    public function test_create_gym_member_page_cant_access_by_gym_trainer()
    {
        $response = $this->actingAs($this->gym_trainer)->get('/account-create/gym-member');
        $response->assertStatus(403);
    }
    public function test_create_gym_member_page_cant_access_by_gym_admin()
    {
        $response = $this->actingAs($this->admin)->get('/account-create/gym-member');
        $response->assertStatus(403);
    }

    public function test_create_gym_member_page_can_render()
    {
        $response = $this->get('/account-create/gym-member');
        $response->assertStatus(302);
    }

    public function test_gym_owner_can_create_gym_member_account()
    {
        $data = [
            'name' => 'Test Member',
            'email' => 'testmmber@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
            // Add other required fields as needed
        ];

        $response = $this->actingAs($this->gym_owner)->post('/create-account/gym-member/store', $data);

        $response->assertStatus(302); // Check if the response status is a redirection
        $response->assertRedirect('/gym-member'); // Check if it redirects to the expected URL

    }



    //gym member index page 

    
    public function test_gym_member_page_cant_render_without_auth()
    {
        $response = $this->get('/gym-member');
        $response->assertStatus(302);
    }

    public function test_gym_member_page_cant_access_by_gym_member()
    {
        $response = $this->actingAs($this->gym_member)->get('/gym-member');
        $response->assertStatus(403);
    }
    public function test_gym_member_page_can_access_by_gym_owner()
    {
        $response = $this->actingAs($this->gym_owner)->get('/gym-member');
        $response->assertStatus(200);
    }
    public function test_gym_member_page_cant_access_by_gym_trainer()
    {
        $response = $this->actingAs($this->gym_trainer)->get('/gym-member');
        $response->assertStatus(403);
    }
    public function test_gym_member_page_cant_access_by_gym_admin()
    {
        $response = $this->actingAs($this->admin)->get('/gym-member');
        $response->assertStatus(403);
    }
    

    public function test_gym_member_search(){
        
    }




    
    
}
