<?php

namespace Tests\Feature;

use App\MarriageStatus;
use App\PersonalDetailsSteps;
use App\SpouseAddress;
use App\SpouseEmail;
use App\SpouseEmployer;
use App\SpouseEmployerAddress;
use App\SpouseEmployerBenefits;
use App\SpouseInfo;
use App\SpousePhone;
use App\SpouseSocialMedia;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpouseTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    private $user;
    private $spouseInfo;
    private $spousePhoneNumbers;
    private $spouseEmails;
    private $spouseAddress;
    private $spouseSocialMedia;
    private $spouseEmployer;
    private $personalDetailsStep;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->user = factory(User::class)->states('verified')->create();

        $this->spouseInfo = factory(SpouseInfo::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->spousePhoneNumbers = factory(SpousePhone::class, 3)->create([
            'user_id' => $this->spouseInfo->id
        ]);

        $this->spouseEmails = factory(SpouseEmail::class, 3)->create([
            'user_id' => $this->spouseInfo->id
        ]);

        $this->spouseAddress = factory(SpouseAddress::class)->create([
            'user_id' => $this->spouseInfo->id
        ]);

        $this->spouseSocialMedia = factory(SpouseSocialMedia::class, 2)->create([
            'user_id' => $this->spouseInfo->id
        ]);

        $this->spouseEmployer = factory(SpouseEmployer::class, 2)
            ->create(['user_id' => $this->spouseInfo->id])
            ->each(function ($item) {

                factory(SpouseEmployerAddress::class)->create([
                    'user_id' => $item->user_id,
                    'employer_id' => $item->id
                ]);

                factory(SpouseEmployerBenefits::class)->create([
                    'employer_id' => $item->id
                ]);
            });
        $this->personalDetailsStep = factory(PersonalDetailsSteps::class)->create([
            'step' => 'Are you married?',
            'slug' => 'spouse'
        ]);
    }


    /** @test */
    function an_authenticated_user_can_provide_marriage_information()
    {
        $this->actingAs($this->user)
            ->post('personal/marriage-status', [
                'is_married' => 1
            ])->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('marriage_statuses', [
            'user_id' => $this->user->id,
            'is_married' => 1
        ]);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'user_id' => $this->user->id,
            'step_id' => 2,
            'is_visited' => 1,
            'is_filled' => 1,
            'is_completed' => 0
        ]);
    }

    /** @test */
    function an_authenticated_user_can_get_marriage_information()
    {
        $marriageInformation = factory(MarriageStatus::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->actingAs($this->user)->get('personal/marriage-status')
            ->assertStatus(200)
            ->assertJsonFragment([
                'user_id' => $this->user->id,
                'is_married' => false
            ]);
    }

    /** @test */
    function an_authenticated_user_can_update_spouse_information_step()
    {
        $this->actingAs($this->user)
            ->postJson('steps', [
                'step_id' => 2,
                'is_visited' => 1
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'step_id' => 2,
            'user_id' => $this->user->id,
        ]);
    }

    /** @test */
    function an_authenticated_user_can_submit_spouse_information()
    {
        $this->actingAs($this->user)
            ->post('personal/spouse-info', [
                'marriage_location' => 'Marriage Location',
                'marriage_date' => '05/03/1998',
                'legal_name' => 'Pawan Kumar',
                'nickname' => 'Ricky',
                'dob' => '02/05/1990',
                'country_id' => $this->spouseInfo->country_id,
                'passport_number' => '123456789',
                'father_name' => 'John Doe',
                'father_birth_place' => 'New York',
                'mother_name' => 'John Dee',
                'mother_birth_place' => 'New York',
                'spouse_address' => $this->spouseAddress->toJson(),
                'phones' => $this->spousePhoneNumbers->toJson(),
                'emails' => $this->spouseEmails->toJson(),
                'spouse_social_media' => $this->spouseSocialMedia->toJson(),
                'spouse_employer' => $this->spouseEmployer->toJson(),
                'is_completed' => 1
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('spouse_infos', [
            'user_id' => $this->user->id,
            'legal_name' => 'Pawan Kumar',
            'nickname' => 'Ricky'
        ]);

        $this->assertDatabaseHas('spouse_phones', [
            'user_id' => $this->user->id
        ]);

        $this->assertDatabaseHas('spouse_emails', [
            'user_id' => $this->user->id
        ]);

        $this->assertDatabaseHas('spouse_social_media', [
            'user_id' => $this->user->id
        ]);

        $this->assertDatabaseHas('spouse_employers', [
            'user_id' => $this->user->id
        ]);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'user_id' => $this->user->id,
            'step_id' => 2,
            'is_completed' => 1
        ]);
    }

    /** @test */
    function an_authenticated_user_can_update_spouse_information()
    {
        $this->actingAs($this->user)->put("/personal/spouse-info/" . $this->spouseInfo->id, [
            'marriage_location' => 'New Marriage Location',
            'marriage_date' => '05/03/1998',
            'legal_name' => 'Ricky Kumar',
            'nickname' => 'Rocky',
            'dob' => '02/05/1990',
            'country_id' => $this->spouseInfo->country_id,
            'passport_number' => '1234566',
            'father_name' => 'John Doe',
            'father_birth_place' => 'New York',
            'mother_name' => 'John Dee',
            'mother_birth_place' => 'New York',
            'spouse_address' => $this->spouseAddress->toJson(),
            'phones' => $this->spousePhoneNumbers->toJson(),
            'emails' => $this->spouseEmails->toJson(),
            'spouse_social_media' => $this->spouseSocialMedia->toJson(),
            'spouse_employer' => $this->spouseEmployer->toJson(),
            'is_completed' => true
        ])->dump()
            ->assertStatus(201);
    }

    /** @test */
    function an_authenticated_user_can_update_partial_information()
    {
        $phones = [
            'phone' => null
        ];

        $emails = [
            'email' => null,
            'password' => null
        ];
        $this->actingAs($this->user)->put("/personal/spouse-info/" . $this->spouseInfo->id, [
            'marriage_location' => 'New Marriage Location',
            'marriage_date' => '05/03/1998',
            'legal_name' => 'Ricky Kumar',
            'nickname' => 'Rocky',
            'dob' => '02/05/1990',
            'country_id' => $this->spouseInfo->country_id,
            'passport_number' => '1234566',
            'father_name' => 'John Doe',
            'father_birth_place' => 'New York',
            'mother_name' => 'John Dee',
            'mother_birth_place' => 'New York',
            'spouse_address' => $this->spouseAddress->toJson(),
            'phones' => json_encode($phones),
            'emails' => json_encode($emails),
            'spouse_social_media' => $this->spouseSocialMedia->toJson(),
            'spouse_employer' => $this->spouseEmployer->toJson(),
            'is_completed' => false
        ])->dump()
            ->assertStatus(201);
    }

    /** @test */
    function an_authenticated_user_can_remove_spouse_information()
    {
        $this->actingAs($this->user)
            ->json('DELETE', '/personal/spouse-info/' . $this->spouseInfo->id)
            ->dump();

        $this->assertDatabaseMissing('spouse_employers', [
            'user_id' => $this->spouseInfo->id
        ]);

        $this->assertDatabaseMissing('spouse_social_media', [
            'id' => $this->spouseSocialMedia[0]->id
        ]);

        $this->assertDatabaseMissing('spouse_emails', [
            'id' => $this->spouseEmails[0]->id
        ]);

        $this->assertDatabaseMissing('spouse_infos', [
            'id' => $this->spouseInfo->id
        ]);
    }

}
