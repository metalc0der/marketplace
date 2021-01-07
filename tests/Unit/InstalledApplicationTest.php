<?php

namespace Metalc0der\Marketplace\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Metalc0der\Marketplace\Tests\TestCase;
use Metalc0der\Marketplace\Models\InstalledApplication;

class InstalledApplicationTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  function it_inserts_in_installed_applications()
  {
    InstalledApplication::factory()->create([
        'application_id' => 'fake_application'
    ]);

    $applications = InstalledApplication::all();
    $this->assertDatabaseCount('installed_applications', 1);
    $this->assertEquals('fake_application', $applications->first()->application_id);
  }
}