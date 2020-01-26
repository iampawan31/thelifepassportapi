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

    /** @test **/
    function user_can_submit_personal_info()
    {
        $user = factory(User::class)->create();
        $personalInfo = factory(PersonalInfo::class)->create([
            'user_id' => $user->id
        ]);

        $phoneNumbers = factory(UserPhone::class, 3)->create([
            'user_id' => $user->id
        ]);

        $userEmails = factory(UserEmail::class, 3)->create([
            'user_id' => $user->id
        ]);

        $personalAddress = factory(PersonalAddress::class)->create([
            'user_id' => $user->id
        ]);

        $userSocialMedia = factory(UserSocialMedia::class, 2)->create([
            'user_id' => $user->id
        ]);

        $userEmployer = factory(UserEmployer::class)->create([
            'user_id' => $user->id
        ]);

        $userEmployer['address'] = factory(EmployerAddress::class)->create([
            'user_id' => $user->id,
            'employer_id' => $userEmployer->user_id
        ]);

        factory(PersonalDetailsSteps::class)->create();

        $userEmployer['benefits'] = factory(PersonalEmployerBenefits::class)->create([
            'user_id' => $user->id,
            'employer_id' => $userEmployer->user_id
        ]);

        $this->actingAs($user)->post('/personal-info/postdata', [
            'legal_name' => $personalInfo->legal_name,
            'nickname' => $personalInfo->nickname,
            'dob' => $personalInfo->dob,
            'citizenship' => $personalInfo->country_id,
            'passport_number' => $personalInfo->passport_number,
            'father_name' => $personalInfo->father_name,
            'father_birth_place' => $personalInfo->father_birth_place,
            'mother_name' => $personalInfo->mother_name,
            'mother_birth_place' => $personalInfo->mother_birth_place,
            'home_address' => $personalAddress,
            'phone' => $phoneNumbers,
            'email' => $userEmails,
            'social_media_type' => $userSocialMedia,
            'user_employer' => $userEmployer,
            'is_completed' => true
        ])
            ->assertStatus(200);
    }
}
