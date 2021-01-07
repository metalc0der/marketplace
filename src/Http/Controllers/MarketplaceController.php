<?php

namespace Metalc0der\Marketplace\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;
use Metalc0der\Marketplace\MarketplaceManager;
use Metalc0der\Marketplace\Resources\InstalledApplicationResource;

class MarketplaceController extends Controller
{
    protected $marketplace_manager;

    public function __construct(MarketplaceManager $marketplace_manager)
    {
        $this->marketplace_manager = $marketplace_manager;
    }

    public function install($application_id)
    {
        return new InstalledApplicationResource($this->marketplace_manager->install($application_id));
    }

    public function uninstall($application_id)
    {
        $this->marketplace_manager->uninstall($application_id);
    }

    public function discoverPlugins()
    {
        return ['applications' => $this->marketplace_manager->getAvailablePlugins()];
    }
}