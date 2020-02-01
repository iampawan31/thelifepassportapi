<?php

namespace Tests\Feature;

use App\EmployerAddress;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\UserEmail;
use App\PersonalAddress;
use App\PersonalDetailsSteps;
use App\PersonalEmployerBenefits;
use App\PersonalInfo;
use App\UserEmployer;
use App\UserPhone;
use App\UserSocialMedia;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PersonalInfoTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    private $user;
    private $personalInfo;
    private $phoneNumbers;
    private $userEmails;
    private $personalAddress;
    private $userSocialMedia;
    private $userEmployer;
    private $personalDetailsStep;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->states('verified')->create();

        $this->personalInfo = factory(PersonalInfo::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->phoneNumbers = factory(UserPhone::class, 3)->create([
            'user_id' => $this->user->id
        ]);

        $this->userEmails = factory(UserEmail::class, 3)->create([
            'user_id' => $this->user->id
        ]);

        $this->personalAddress = factory(PersonalAddress::class)->create([
            'user_id' => $this->user->id
        ]);

        $this->userSocialMedia = factory(UserSocialMedia::class, 2)->create([
            'user_id' => $this->user->id
        ]);

        $this->userEmployer = factory(UserEmployer::class, 2)
            ->create(['user_id' => $this->user->id])
            ->each(function ($item) {
                factory(EmployerAddress::class)->create([
                    'user_id' => $item->user_id,
                    'employer_id' => $item->id
                ]);

                factory(PersonalEmployerBenefits::class)->create([
                    'employer_id' => $item->id
                ]);
            });

        $this->personalDetailsStep = factory(PersonalDetailsSteps::class)->create();
    }

    /** @test */
    function authenticated_user_can_get_personal_information()
    {
        $this->actingAs($this->user, 'api')->getJson('/api/personal-info')
            ->dump()
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $this->user->name
            ]);
    }

    /** @test * */
    function user_can_submit_personal_info()
    {
        $newUser = factory(User::class)->states('verified')->create();

        $this->actingAs($newUser, 'api')
            ->postJson('/api/personal-info', [
                'legal_name' => 'Pawan Kumar',
                'nickname' => 'Ricky',
                'dob' => '02/05/1990',
                'country_id' => $this->personalInfo->country_id,
                'passport_number' => '123456789',
                'father_name' => 'John Doe',
                'father_birth_place' => 'New York',
                'mother_name' => 'John Dee',
                'mother_birth_place' => 'New York',
                'personal_address' => $this->personalAddress->toJson(),
                'phones' => $this->phoneNumbers->toJson(),
                'emails' => $this->userEmails->toJson(),
                'user_social_media' => $this->userSocialMedia->toJson(),
                'user_employer' => $this->userEmployer->toJson(),
                'is_completed' => true
            ])
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('personal_info', [
            'user_id' => $newUser->id,
            'legal_name' => 'Pawan Kumar',
            'passport_number' => '123456789',
            'father_name' => 'John Doe',
            'father_birth_place' => 'New York',
            'mother_name' => 'John Dee',
            'mother_birth_place' => 'New York'
        ]);
    }

    /** @test * */
    function user_can_update_personal_information()
    {
        $newAddress = factory(PersonalAddress::class)->create()->toJson();
        $this->actingAs($this->user, 'api')
            ->putJson(
                "api/personal-info/" . $this->personalInfo->id,
                [
                    'legal_name' => 'John Doe',
                    'nickname' => 'John',
                    'dob' => $this->personalInfo->dob,
                    'country_id' => $this->personalInfo->country_id,
                    'passport_number' => $this->personalInfo->passport_number,
                    'father_name' => 'Adam Doe',
                    'father_birth_place' => 'Adam Birth Place',
                    'mother_name' => 'Martha Doe',
                    'mother_birth_place' => 'Martha Birth Place',
                    'personal_address' => $newAddress,
                    'user_phones' => $this->phoneNumbers->toJson(),
                    'user_emails' => $this->userEmails->toJson(),
                    'user_social_media' => $this->userSocialMedia->toJson(),
                    'user_employer' => $this->userEmployer->toJson(),
                    'is_completed' => true
                ]
            )
            ->dump()
            ->assertStatus(201);

        $this->assertDatabaseHas('personal_info', [
            'user_id' => $this->user->id,
            'legal_name' => 'John Doe',
            'nickname' => 'John',
            'father_name' => 'Adam Doe',
            'father_birth_place' => 'Adam Birth Place',
            'mother_name' => 'Martha Doe',
            'mother_birth_place' => 'Martha Birth Place',
        ]);
    }

    /** @test * */
    function user_can_update_personal_information_completion_step()
    {
        $this->actingAs($this->user, 'api')
            ->postJson('api/steps', [
                'step_id' => 1,
                'is_visited' => 1
            ])
            ->dump()
            ->assertStatus(201);
    }
}
