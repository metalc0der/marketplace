<?php

namespace Metalc0der\Marketplace\Tests\Feature;

use Metalc0der\Marketplace\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Metalc0der\Marketplace\Models\InstalledApplication;
use Metalc0der\Marketplace\Models\Setting;
use Metalc0der\Marketplace\Tests\TestCase;

class SaveSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_saves_settings()
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

        $this->assertCount(1, Setting::all());

        tap(Setting::first(), function ($setting) use($user) {
            $this->assertEquals('fake_key', $setting->key);
            $this->assertEquals('fake_value', $setting->value);
            $this->assertEquals($user->id, $setting->seteable_id);
            $this->assertEquals(User::class, $setting->seteable_type);
        });

        $this->actingAs($user)->post(route('settings.save', [
            'application_id' => $application->id,
            'owner_id' => $user->id,
            'owner_type' => User::class,
            'settings' => [
                'fake_key' => 'fake_value_2'
            ]
        ]));

        $this->assertCount(1, Setting::all());

        tap(Setting::first(), function ($setting) use($user) {
            $this->assertEquals('fake_key', $setting->key);
            $this->assertEquals('fake_value_2', $setting->value);
            $this->assertEquals($user->id, $setting->seteable_id);
            $this->assertEquals(User::class, $setting->seteable_type);
        });
    }
}