<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Customer extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * @var array casts attributes to native types.
     */
    protected $casts = [
        'is_transparent' => 'boolean',
    ];

    /*
     * Validation
     */
    public $rules = [
    ];

    public $belongsTo = [
        'sector' => [\Alemba\Alemba\Models\CustomerSector::class, 'order' => 'name']
    ];

    public $hasOne = [
        'successstory' => [\Alemba\Alemba\Models\SuccessStory::class]
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_customers';
}