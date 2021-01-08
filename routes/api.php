<?php

use Illuminate\Support\Facades\Route;
use Metalc0der\Marketplace\Http\Controllers\MarketplaceController;
use Metalc0der\Marketplace\Http\Controllers\SettingController;

/***************************************************
 *
 * Applications
 *
 ***************************************************/
Route::group(['prefix' => 'applications'], function () {
    Route::post('/{application_id}/install', [MarketplaceController::class, 'install'])->name('marketplace.install');
    Route::post('/{application_id}/uninstall', [MarketplaceController::class, 'uninstall'])->name('marketplace.uninstall');
    Route::get('/discover', [MarketplaceController::class, 'discoverPlugins'])->name('marketplace.discover');
});

/***************************************************
 *
 * Settings
 *
 ***************************************************/
Route::group(['prefix' => 'settings'], function () {
    Route::post('/save', [SettingController::class, 'save'])->name('settings.save');
    Route::post('/search', [SettingController::class, 'search'])->name('settings.search');
});
