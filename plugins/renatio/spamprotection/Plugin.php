<?php

namespace Renatio\SpamProtection;

use Cms\Classes\CmsController;
use Renatio\SpamProtection\Components\SpamProtection;
use Spatie\Honeypot\HoneypotServiceProvider;
use Spatie\Honeypot\ProtectAgainstSpam;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'renatio.spamprotection::lang.plugin.name',
            'description' => 'renatio.spamprotection::lang.plugin.description',
            'author' => 'Renatio',
            'icon' => 'octo-icon-shield',
        ];
    }

    public function boot()
    {
        $this->app->register(HoneypotServiceProvider::class);

        CmsController::extend(function ($controller) {
            $controller->middleware(ProtectAgainstSpam::class);
        });
    }

    public function registerComponents()
    {
        return [
            SpamProtection::class => 'spamProtection',
        ];
    }
}
