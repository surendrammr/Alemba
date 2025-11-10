<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class ConnectorCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Sortable;

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_connector_categories';

    public $belongsToMany = [
        'connectors' => [
            'Alemba\Alemba\Models\Connector',
            'table' => 'alemba_alemba_category_connectors',
            'order' => 'name asc'
        ]
    ];
}