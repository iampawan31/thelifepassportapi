<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SpouseTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /** @test */
    function an_authenticated_user_can_provide_marriage_information()
    {
        $user = factory(User::class)->states('verified')->create();

        $this->actingAs($user, 'api')->postJson('personal-info/marriage-status', [
            'is_married' => 0
        ])->dump()->assertStatus(201);
    }

}
