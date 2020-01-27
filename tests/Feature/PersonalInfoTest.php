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

class PersonalInfoTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    private $user;
    private $personalInfo;
    private $phoneNumbers;
    private $userEmails;
    private $personalAddress;
    private $userSocialMedia;
    private $userEmployer;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();

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

        factory(PersonalDetailsSteps::class)->create();
    }

    /** @test **/
    function user_can_submit_personal_info()
    {
        $this->actingAs($this->user)->post('/personal-info/postdata', [
            'legal_name' => $this->personalInfo->legal_name,
            'nickname' => $this->personalInfo->nickname,
            'dob' => $this->personalInfo->dob,
            'citizenship' => $this->personalInfo->country_id,
            'passport_number' => $this->personalInfo->passport_number,
            'father_name' => $this->personalInfo->father_name,
            'father_birth_place' => $this->personalInfo->father_birth_place,
            'mother_name' => $this->personalInfo->mother_name,
            'mother_birth_place' => $this->personalInfo->mother_birth_place,
            'personal_address' => $this->personalAddress,
            'phone' => $this->phoneNumbers,
            'email' => $this->userEmails,
            'social_media_type' => $this->userSocialMedia,
            'user_employer' => $this->userEmployer,
            'is_completed' => true
        ])
            ->assertStatus(200);
    }
}
