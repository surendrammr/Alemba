<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class PartnerResourceGroup extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_partner_resource_groups';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public $hasMany = [
        'resources' => ['Alemba\Alemba\Models\PartnerResource', 'key' => 'group_id']
    ];

}
