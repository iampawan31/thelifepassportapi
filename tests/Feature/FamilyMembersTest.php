<?php

namespace Tests\Feature;

use App\FamilyMemberAddress;
use App\FamilyMembers;
use App\FamilyPhone;
use App\FamilyRelation;
use App\FamilyStatus;
use App\PersonalDetailsSteps;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FamilyMembersTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    private $user;
    private $personalDetailsStep;
    private $familyMember;
    private $familyMemberPhone;
    private $familyMemberAddress;
    private $familyRelation;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->user = factory(User::class)->states('verified')->create();

        $this->familyRelation = factory(FamilyRelation::class)->create();

        $this->familyMember = factory(FamilyMembers::class)->create([
            'user_id' => $this->user->id
        ]);
        $this->familyMemberPhone = factory(FamilyPhone::class, 2)->create([
            'user_id' => $this->user->id,
            'family_member_id' => $this->familyMember->id
        ]);
        $this->familyMemberAddress = factory(FamilyMemberAddress::class)->create([
            'user_id' => $this->user->id,
            'family_member_id' => $this->familyMember->id,
        ]);

        $this->personalDetailsStep = factory(PersonalDetailsSteps::class)->create([
            'step' => 'Would you like to add close family members including children?',
            'slug' => 'family_members'
        ]);

        $this->familyStatus = factory(FamilyStatus::class)->create([
            'user_id' => $this->user->id,
            'has_family_member' => true,
            'count' => 1
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_step_for_adding_family_members()
    {
        $this->actingAs($this->user)
            ->postJson('/steps', [
                'step_id' => 4,
                'is_visited' => "1"
            ])->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'step_id' => 4,
            'is_visited' => '1'
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_family_member_status()
    {
        $this->actingAs($this->user)->post('personal/family/status', [
            'has_family_member' => 1
        ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('family_statuses', [
            'user_id' => $this->user->id
        ]);
    }

    /** @test */
    function an_authenticated_user_can_get_family_member_status_information()
    {
        $this->actingAs($this->user)->get('personal/family/status')
            ->dump()
            ->assertStatus(200)
            ->assertSee('has_family_member');
    }

    /** @test */
    function an_authenticated_user_can_fetch_family_member_info()
    {
        $this->actingAs($this->user)->get('personal/family')
            ->dump()
            ->assertSee('address')
            ->assertSee('phone')
            ->assertSee('relation')
            ->assertStatus(200);
    }

    /** @test */
    function an_authenticated_user_can_remove_family_member()
    {

        $this->actingAs($this->user)->delete('personal/family/' . $this->familyMember->id)
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseMissing('family_members', [
            'id' => $this->familyMember->id
        ]);

        $this->assertDatabaseMissing('family_phones', [
            'family_member_id' => $this->familyMember->id
        ]);

        $this->assertDatabaseMissing('family_relations', [
            'family_member_id' => $this->familyMember->id
        ]);

        $this->assertDatabaseHas('family_statuses', [
            'user_id' => $this->user->id,
            'has_family_member' => false,
            'count' => '0'
        ]);
    }

    /** @test */
    function an_authenticated_user_can_fetch_family_relations()
    {
        $this->actingAs($this->user)->get('personal/family/create')
            ->dump()
            ->assertStatus(200)
            ->assertSee($this->familyRelation->title)
            ->assertSee($this->familyRelation->id);
    }

    /** @test */
    function an_authenticated_user_can_fetch_family_member_info_for_editing()
    {
        $this->actingAs($this->user)->get('personal/family/' . $this->familyMember->id . '/edit')
            ->dump()
            ->assertSee($this->familyMember->id)
            ->assertSee('phone')
            ->assertSee('address');
    }

    /** @test */
    function an_authenticated_user_can_submit_family_member_information()
    {
        $newUser = factory(User::class)->states('verified')->create();

        $this->actingAs($newUser)->post('personal/family', [
            'legal_name' => 'Pawan Kumar',
            'relationship_id' => 1,
            'relationship_other' => '',
            'address' => $this->familyMemberAddress,
            'dob' => '05/02/1990',
            'email' => 'surpawan@gmail.com',
            'phone' => $this->familyMemberPhone->toJson()
        ])
        ->dump()
        ->assertStatus(201);

        $this->assertDatabaseHas('family_members', [
            'legal_name' => 'Pawan Kumar',
            'relationship_id' => 1,
            'relationship_other' => null,
            'email' => 'surpawan@gmail.com'
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_family_member_information()
    {
        $this->actingAs($this->user)->put('personal/family/' . $this->familyMember->id, [
            'legal_name' => 'Pawan Kumar',
            'relationship_id' => 1,
            'relationship_other' => '',
            'dob' => '02/02/1990',
            'email' => 'surpawan@gmail.com'
        ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('family_members', [
            'legal_name' => 'Pawan Kumar',
            'relationship_id' => 1,
            'relationship_other' => null,
            'email' => 'surpawan@gmail.com'
        ]);
    }
}
