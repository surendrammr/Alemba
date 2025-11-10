<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class ReleaseSection extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;
    
    use \October\Rain\Database\Traits\Sortable;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_release_sections';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
