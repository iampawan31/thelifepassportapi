<?php

namespace Tests\Feature;

use App\SocialMedia;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SocialMediaTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    private $social;

    protected function setUp(): void
    {
        parent::setUp();

        $this->social = factory(SocialMedia::class, 1)->create();
    }

    /** @test */
    function user_can_fetch_all_social_media_details()
    {
        $user = factory(User::class)->states('verified')->create();

        $this->actingAs($user)
            ->getJson('/social')
            ->assertJsonFragment([
                'text' => $this->social[0]->title
            ]);
    }
}
