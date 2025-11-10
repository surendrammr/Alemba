<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Roadmap extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_roadmap';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
