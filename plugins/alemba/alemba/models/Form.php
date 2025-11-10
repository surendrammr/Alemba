<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Form extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_forms';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

}
