<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class PartnerResource extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_partner_resources';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $belongsTo = [
        'group' => [
            'Alemba\Alemba\Models\PartnerResourceGroup',
            'table' => 'alemba_alemba_partner_resource_groups',
            'key' => 'group_id'
        ]
    ];
}
