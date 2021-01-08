<?php

namespace Metalc0der\Marketplace\Tests\Feature;

use Metalc0der\Marketplace\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metalc0der\Marketplace\Models\InstalledApplication;
use Metalc0der\Marketplace\Models\Setting;
use Metalc0der\Marketplace\Tests\TestCase;

class GetSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_retrieves_settings()
    {
        $this->assertCount(0, Setting::all());

        $user = User::factory()->create();
        
        $this->actingAs($user)->post(route('marketplace.install', [
            'application_id' => 'fake_application'
        ]));

        $application = InstalledApplication::first();

        $this->actingAs($user)->post(route('settings.save', [
            'application_id' => $application->id,
            'owner_id' => $user->id,
            'owner_type' => User::class,
            'settings' => [
                'fake_key' => 'fake_value'
            ]
        ]));

        $response = $this->actingAs($user)->post(route('settings.search', [
            'application_id' => $application->id,
            'owner_id' => $user->id,
            'owner_type' => User::class
        ]));

        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment([
            'owner_type' => User::class,
            'application_id' => $application->id,
            'owner_id' => $user->id,
            'key' => 'fake_key',
            'value' => 'fake_value'
        ]);
    }
}