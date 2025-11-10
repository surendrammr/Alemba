<?php namespace Alemba\Alemba\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class EmployeeQuotes extends Controller
{
    public $implement = ['Backend\Behaviors\ListController','Backend\Behaviors\FormController','Backend\Behaviors\ReorderController'];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public $requiredPermissions = [
        'alemba.alemba.' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Alemba.Alemba', 'company', 'employee-quotes');
    }
}