<?php

namespace Tests\Feature;

use App\Country;
use App\EmployerBenefitsMaster;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BenefitTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    private $benefit;

    protected function setUp(): void
    {
        parent::setUp();

        $this->benefit = factory(EmployerBenefitsMaster::class, 1)->create();
    }

    /** @test */
    function user_can_fetch_all_employer_benefits()
    {
        $user = factory(User::class)->states('verified')->create();

        $this->actingAs($user)
            ->getJson('/benefits')
            ->assertJsonFragment([
                'title' => $this->benefit[0]->title
            ]);
    }
}
