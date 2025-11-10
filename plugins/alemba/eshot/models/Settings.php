<?php namespace Alemba\EShot\models;


use October\Rain\Database\Model;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'moka_eshot_settings';

    public $settingsFields = 'fields.yaml';

    protected $cache = [];

}
