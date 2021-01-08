<?php

namespace Metalc0der\Marketplace\Http\Controllers;

use Illuminate\Http\Request;
use Metalc0der\Marketplace\MarketplaceManager;
use Metalc0der\Marketplace\Resources\SettingResource;

class SettingController extends Controller
{
    protected $marketplace_manager;

    public function __construct(MarketplaceManager $marketplace_manager)
    {
        $this->marketplace_manager = $marketplace_manager;
    }

    public function save(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'application_id' => 'required',
            'owner_id' => 'required',
            'owner_type' => 'required'
        ]);

        $saved_settings = $this->marketplace_manager->saveSettings($request->settings, $request->owner_id, $request->owner_type, $request->application_id);

        return SettingResource::collection($saved_settings);
    }

    public function search(Request $request)
    {
        $request->validate([
            'application_id' => 'required'
        ]);

        $settings = $this->marketplace_manager->getSettings($request->application_id, $request->get('owner_id', null), $request->get('owner_type', null));

        return SettingResource::collection($settings);
    }
}