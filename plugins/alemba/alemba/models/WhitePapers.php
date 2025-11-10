<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class WhitePapers extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    
    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_whitepapers';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
