<?php

namespace Tests\Feature;

use App\PersonalDetailsSteps;
use App\PersonalEstate;
use App\PersonalEstateAddress;
use App\PersonalEstateStatus;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PersonalEstateTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    private $user;
    private $personalEstate;
    private $personalEstateAddress;
    private $personalEstateStatus;
    private $personalStep;
    private $testPersonalEstateAddress;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->user = factory(User::class)->states('verified')->create();
        $this->personalEstate = factory(PersonalEstate::class)->create([
            'user_id' => $this->user->id
        ]);
        $this->personalEstateAddress = factory(PersonalEstateAddress::class)->create([
            'user_id' => $this->user->id,
            'estate_id' => $this->personalEstate->id
        ]);

        $this->testPersonalEstateAddress = factory(PersonalEstateAddress::class)->create();

        $this->personalEstateStatus = factory(PersonalEstateStatus::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->personalStep = factory(PersonalDetailsSteps::class)->create([
            'id' => 7
        ]);

    }

    /** @test */
    function an_authenticated_user_can_update_personal_estate_step()
    {
        $this->actingAs($this->user)->post('steps', [
            'step_id' => 7,
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'step_id' => 7
        ]);

    }

    /** @test */
    function an_authenticated_user_can_fetch_estate_representative_information()
    {
        $this->actingAs($this->user)->get('personal/estate')
            ->dump()
            ->assertSee('address')
            ->assertStatus(200);
    }

    /** @test */
    function an_authenticated_user_can_add_an_estate_representative_information()
    {
        $this->actingAs($this->user)->post('personal/estate', [
            'legal_name' => 'Pawan Kumar',
            'relationship' => 'Dummy Relation',
            'company' => 'Dummy Company',
            'address' => $this->testPersonalEstateAddress->toJson(),
            'phone' => '8123565698',
            'email' => 'contact@dummycompany.com',
            'website' => 'www.dummycompany.com',
            'is_completed' => 1
        ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('personal_estates', [
            'user_id' => $this->user->id,
            'legal_name' => 'Pawan Kumar',
            'company' => 'Dummy Company',
            'phone' => '8123565698',
            'email' => 'contact@dummycompany.com',
            'website' => 'www.dummycompany.com'
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_an_estate_representative_information()
    {
        $this->actingAs($this->user)->put('personal/estate/' . $this->personalEstate->id, [
            'legal_name' => 'Ricky Kumar',
            'relationship' => 'Dummy Relation',
            'company' => 'Dummy Company',
            'address' => $this->testPersonalEstateAddress->toJson(),
            'phone' => '8123565699',
            'email' => 'contact@dummycompany.com',
            'website' => 'www.dummycompany.com',
            'is_completed' => 1
        ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('personal_estates', [
            'user_id' => $this->user->id,
            'legal_name' => 'Ricky Kumar',
            'company' => 'Dummy Company',
            'phone' => '8123565699',
            'email' => 'contact@dummycompany.com',
            'website' => 'www.dummycompany.com'
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_estate_representative_step()
    {
        $this->actingAs($this->user)
            ->post('steps', [
                'step_id' => 7,
                'is_visited' => 1
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'user_id' => auth()->id(),
            'step_id' => 7
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_personal_estate_status()
    {
        $this->actingAs($this->user)
            ->post('personal/estate/status', [
                'has_personal_estate' => 1
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('personal_estate_statuses', [
            'user_id' => $this->user->id,
            'has_personal_estate' => 1
        ]);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'user_id' => auth()->id(),
            'step_id' => 7,
            'is_filled' => 1,
            'is_visited' => 1,
            'is_completed' => 1
        ]);
    }


}
