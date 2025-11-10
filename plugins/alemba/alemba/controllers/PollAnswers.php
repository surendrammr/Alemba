<?php namespace Alemba\Alemba\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class PollAnswers extends Controller
{
    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\ImportExportController'];
    
    public $listConfig = 'config_list.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = [
        'alemba.alemba.' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Alemba.Alemba', 'events', 'pollanswers');
    }
}