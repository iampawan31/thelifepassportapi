<?php

namespace Tests\Feature;

use App\Country;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    private $country;

    protected function setUp(): void
    {
        parent::setUp();

        $this->country = factory(Country::class, 1)->create();
    }

    /** @test */
    function user_can_fetch_all_countries()
    {
        $user = factory(User::class)->states('verified')->create();

        $this->actingAs($user, 'api')
            ->getJson('api/countries')
            ->assertJsonFragment([
                'text' => $this->country[0]->country_name
            ]);
    }
}
