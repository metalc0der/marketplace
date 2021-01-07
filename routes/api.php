<?php

use Illuminate\Support\Facades\Route;
use Metalc0der\Marketplace\Http\Controllers\MarketplaceController;

Route::post('/{application_id}/install', [MarketplaceController::class, 'install'])->name('marketplace.install');
Route::post('/{application_id}/uninstall', [MarketplaceController::class, 'uninstall'])->name('marketplace.uninstall');
Route::get('/discover', [MarketplaceController::class, 'discoverPlugins'])->name('marketplace.discover');
