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

        $this->userEmployers = factory(UserEmployer::class, 2)
            ->create(['user_id' => $this->user->id])
            ->each(function ($item, $key) {
                factory(EmployerAddress::class)->create([
                    'user_id' => $item->user_id,
                    'employer_id' => $item->id
                ]);

                factory(PersonalEmployerBenefits::class)->create([
                    'user_id' => $item->user_id,
                    'employer_id' => $item->id
                ]);
            });

        $this->personalDetailsStep = factory(PersonalDetailsSteps::class)->create();
    }

    /** @test **/
    function user_can_submit_personal_info()
    {
        $newUser = factory(User::class)->states('verified')->create();

        $this->actingAs($newUser)->post('/personal-info', [
            'legal_name' => 'Pawan Kumar',
            'nickname' => 'Ricky',
            'dob' => '02/05/1990',
            'country_id' => $this->personalInfo->country_id,
            'passport_number' => '123456789',
            'father_name' => 'John Doe',
            'father_birth_place' => 'New York',
            'mother_name' => 'John Dee',
            'mother_birth_place' => 'New York',
            'personal_address' => $this->personalAddress,
            'phones' => $this->phoneNumbers,
            'emails' => $this->userEmails,
            'user_social_media' => $this->userSocialMedia,
            'user_employer' => $this->userEmployer,
            'is_completed' => true
        ])->assertStatus(201);

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

    /** @test **/
    function user_can_update_personal_information()
    {
        $this->actingAs($this->user)->putJson(
            "personal-info/" . $this->personalInfo->id,
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
                'personal_address' => $this->personalAddress,
                'phones' => $this->phoneNumbers,
                'emails' => $this->userEmails,
                'user_social_media' => $this->userSocialMedia,
                'user_employer' => $this->userEmployer,
                'is_completed' => true
            ]
        )->assertStatus(201);

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

    /** @test **/
    function user_can_update_personal_information_completion_step()
    {
        $this->actingAs($this->user)
            ->post('personal-info/steps', [
                'step_id' => 1,
                'is_visited' => 1
            ])->assertStatus(201);

        $this->assertDatabaseHas('users_personal_details_completions', [
            'step_id' => 1,
            'is_visited' => 1,
            'user_id' => $this->user->id
        ]);
    }
}
