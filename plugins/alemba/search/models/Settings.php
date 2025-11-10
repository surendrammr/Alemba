<?php namespace Alemba\Search\Models;

use System\Models\SettingModel;

class Settings extends SettingModel
{
    //
    // The code under which your settings are stored in the DB
    //
    public $settingsCode   = 'alemba_search_settings';

    //
    // Points to your YAML definition, relative to this plugin folder.
    //
    public $settingsFields = 'fields.yaml';

    //
    // Whitelist your fillable columns
    //
    protected $fillable = [
        'algolia_app_id',
        'algolia_api_key',
        'algolia_search_key'
    ];
}