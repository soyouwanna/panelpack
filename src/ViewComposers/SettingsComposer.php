<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\SysSetting;
use App\Map;
class SettingsComposer
{
    protected $sysSettings;
    public function __construct(SysSetting $sysSetting)
    {
        $settings = $sysSetting->all();
        foreach($settings as $setting){
            $this->sysSettings[$setting->name] = $setting->value;
        }
        $map = Map::first();
        $this->sysSettings['address'] = $map->address;
    }

    public function compose(View $view)
    {
        $view->with('site_settings', $this->sysSettings);
    }
}