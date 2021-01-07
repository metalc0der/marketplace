<?php

namespace Metalc0der\Marketplace;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MarketplaceServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'marketplace');
    $this->app->bind('marketplace', function($app) {
        return new MarketplaceManager();
    });
  }

  public function boot()
  {
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

    if ($this->app->runningInConsole()) {
      $this->publishes([
        __DIR__.'/../config/config.php' => config_path('marketplace.php'),
      ], 'config');
    }

    $this->registerRoutes();

  }

  protected function registerRoutes()
  {
      Route::group($this->routeConfiguration(), function () {
          $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
      });
  }

  protected function routeConfiguration()
  {
      return [
          'prefix' => config('blogpackage.prefix'),
          'middleware' => config('blogpackage.middleware'),
      ];
  }
}