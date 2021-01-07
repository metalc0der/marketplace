<?php

namespace Metalc0der\Marketplace\Tests;

use Illuminate\Support\Facades\Schema;
use Metalc0der\Marketplace\MarketplaceServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  public function setUp(): void
  {
    parent::setUp();

  }

  protected function getPackageProviders($app)
  {
    return [
      MarketplaceServiceProvider::class,
    ];
  }

  protected function getEnvironmentSetUp($app)
  {

  }
}