<?php

namespace Decoweb\Panelpack\ViewComposers;

use Illuminate\View\View;
use Decoweb\Panelpack\Models\SysSetting;
use Decoweb\Panelpack\Models\Map;
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
        if( null == $map ){
            $this->sysSettings['address']='Map info not set.';
        }else{
            $this->sysSettings['address'] = $map->address;
        }
    }

    public function compose(View $view)
    {
        $view->with('site_settings', $this->sysSettings);
    }
}