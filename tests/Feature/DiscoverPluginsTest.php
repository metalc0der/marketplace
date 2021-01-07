<?php

namespace Metalc0der\Marketplace\Tests\Feature;

use Metalc0der\Marketplace\Tests\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Metalc0der\Marketplace\Tests\TestCase;

class DiscoverPluginsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_discovers_plugins()
    {
        $user = User::factory()->create();
        Config::set('marketplace.plugins_namespace', 'Metalc0der\Marketplace\Tests\Plugins\TestPlugin');
        $response = $this->actingAs($user)->get(route('marketplace.discover'));
        
        $response->assertStatus(200);
        $response->assertExactJson(['applications' => ['test_plugin']]);
    }
}