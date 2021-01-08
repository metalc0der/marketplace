<?php

namespace Metalc0der\Marketplace;

use danog\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Config;
use Metalc0der\Marketplace\Contracts\Pluggable;
use Metalc0der\Marketplace\Models\InstalledApplication;
use Metalc0der\Marketplace\Models\Setting;

class MarketplaceManager
{
    const DEFAULT_PLUGINS_NAMESPACE = '';

    public function install(string $application_id)
    {
        return InstalledApplication::create([
            'application_id' => $application_id,
            'active' => 1
        ]);
    }

    public function uninstall(string $application_id)
    {
        $application = InstalledApplication::where('application_id', $application_id)->first();
        $application->active = 0;
        $application->save();
        $application->delete();
    }

    public function getAvailablePlugins()
    {
        $klass_names = ClassFinder::getClassesInNamespace(Config::get('marketplace.plugins_namespace'), ClassFinder::ALLOW_CLASSES | ClassFinder::RECURSIVE_MODE);
        $plugin_ids = [];

        collect($klass_names)->each(function($klass_name) use(&$plugin_ids) {
            if (in_array(Pluggable::class, class_implements($klass_name))) {
                $plugin_ids[] = $klass_name::application_id();
            }
        });

        return $plugin_ids;
    }

    public function saveSettings($settings, $seteable_id, $seteable_type, $application_id)
    {
        collect($settings)->each(function($value, $key) use($application_id, $seteable_id, $seteable_type) {
            Setting::updateOrCreate(
                ['application_id' => $application_id, 'seteable_id' => $seteable_id, 'seteable_type' => $seteable_type, 'key' => $key],
                ['value' => $value]
            );
        });

        return $this->getSettings($seteable_id, $seteable_type, $application_id);
    }

    public function getSettings($application_id, $seteable_id = null, $seteable_type = null)
    {
        $query = Setting::where('application_id', $application_id);

        $query->when((!is_null($seteable_id)) ? $seteable_id : false, fn ($query, $seteable_id) => $query->where('seteable_id', $seteable_id));
        $query->when((!is_null($seteable_type)) ? $seteable_type : false, fn ($query, $seteable_type) => $query->where('seteable_type', $seteable_type));

        return $query->get();
    }
}