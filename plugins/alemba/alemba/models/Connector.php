<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Connector extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_connectors';

    public $belongsToMany = [
        'categories' => [
            'Alemba\Alemba\Models\ConnectorCategory',
            'table' => 'alemba_alemba_category_connectors',
            'order' => 'sort_order asc'
        ]
    ];
}