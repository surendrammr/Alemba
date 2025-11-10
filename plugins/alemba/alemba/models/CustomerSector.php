<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class CustomerSector extends Model
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
    public $table = 'alemba_alemba_customer_sectors';

    public $hasMany = [
        'customers' => [\Alemba\Alemba\Models\Customer::class, 'key' => 'sector_id', 'order' => 'name']
    ];

}