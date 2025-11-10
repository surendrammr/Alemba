<?php namespace Alemba\Alemba\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Releases extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController', 'Backend\Behaviors\RelationController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public $requiredPermissions = [
        'alemba.alemba.' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Alemba.Alemba', 'software', 'releases');
    }
}
