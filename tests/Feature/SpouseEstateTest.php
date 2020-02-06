<?php

namespace Tests\Feature;

use App\PersonalDetailsSteps;
use App\SpouseEstate;
use App\SpouseEstateAddress;
use App\SpouseEstateStatus;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SpouseEstateTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    private $user;
    private $spouseEstate;
    private $spouseEstateAddress;
    private $spouseEstateStatus;
    private $spouseStep;
    private $testSpouseEstateAddress;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();

        $this->user = factory(User::class)->states('verified')->create();
        $this->spouseEstate = factory(SpouseEstate::class)->create([
            'user_id' => $this->user->id
        ]);
        $this->spouseEstateAddress = factory(SpouseEstateAddress::class)->create([
            'user_id' => $this->user->id,
            'spouse_estate_id' => $this->spouseEstate->id
        ]);

        $this->testSpouseEstateAddress = factory(SpouseEstateAddress::class)->create();

        $this->spouseEstateStatus = factory(SpouseEstateStatus::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->spouseStep = factory(PersonalDetailsSteps::class)->create([
            'id' => 8
        ]);

    }

    /** @test */
    function an_authenticated_user_can_update_spouse_estate_step()
    {
        $this->actingAs($this->user)->post('steps', [
            'step_id' => 8,
        ])
            ->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'step_id' => 8
        ]);

    }

    /** @test */
    function an_authenticated_user_can_fetch_estate_representative_information()
    {
        $this->actingAs($this->user)->get('personal/spouse/estate')
            ->dump()
            ->assertSee('address')
            ->assertStatus(200);
    }

    /** @test */
    function an_authenticated_user_can_add_an_estate_representative_information()
    {
        $this->actingAs($this->user)->post('personal/spouse/estate', [
            'legal_name' => 'Pawan Kumar',
            'relationship' => 'Dummy Relation',
            'company' => 'Dummy Company',
            'address' => $this->testSpouseEstateAddress->toJson(),
            'phone' => '8123565698',
            'email' => 'contact@dummycompany.com',
            'website' => 'www.dummycompany.com',
            'is_completed' => 1
        ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('spouse_estates', [
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
        $this->actingAs($this->user)->put('personal/spouse/estate/' . $this->spouseEstate->id, [
            'legal_name' => 'Ricky Kumar',
            'relationship' => 'Dummy Relation',
            'company' => 'Dummy Company',
            'address' => $this->testSpouseEstateAddress->toJson(),
            'phone' => '8123565699',
            'email' => 'contact@dummycompany.com',
            'website' => 'www.dummycompany.com',
            'is_completed' => 1
        ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('spouse_estates', [
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
                'step_id' => 8,
                'is_visited' => 1
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'user_id' => auth()->id(),
            'step_id' => 8
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_spouse_estate_status()
    {
        $this->actingAs($this->user)
            ->post('personal/spouse/estate/status', [
                'has_spouse_estate' => 1
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('spouse_estate_statuses', [
            'user_id' => $this->user->id,
            'has_spouse_estate' => 1
        ]);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'user_id' => auth()->id(),
            'step_id' => 8,
            'is_filled' => 1,
            'is_visited' => 1,
            'is_completed' => 1
        ]);
    }
}
