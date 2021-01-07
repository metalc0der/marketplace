<?php

namespace Metalc0der\Marketplace\Tests\Feature;

use Metalc0der\Marketplace\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metalc0der\Marketplace\Models\InstalledApplication;
use Metalc0der\Marketplace\Tests\TestCase;

class InstallApplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_installs_an_application()
    {
        $this->assertCount(0, InstalledApplication::all());

        $user = User::factory()->create();

        $this->actingAs($user)->post(route('marketplace.install', [
            'application_id' => 'fake_application'
        ]));

        $this->assertCount(1, InstalledApplication::all());

        tap(InstalledApplication::first(), function ($application) {
            $this->assertEquals('fake_application', $application->application_id);
        });
    }
}