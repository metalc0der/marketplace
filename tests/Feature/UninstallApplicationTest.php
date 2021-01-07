<?php

namespace Metalc0der\Marketplace\Tests\Feature;

use Metalc0der\Marketplace\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metalc0der\Marketplace\Models\InstalledApplication;
use Metalc0der\Marketplace\Tests\TestCase;

class UninstallApplicationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_uninstalls_an_application()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('marketplace.install', [
            'application_id' => 'fake_application'
        ]));

        $this->assertCount(1, InstalledApplication::all());

        $this->actingAs($user)->post(route('marketplace.uninstall', [
            'application_id' => 'fake_application'
        ]));

        $this->assertCount(0, InstalledApplication::all());
        $this->assertCount(1, InstalledApplication::withTrashed()->get());
        $this->assertEquals(0, InstalledApplication::withTrashed()->first()->active);
    }
}