<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class ITIL extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Sortable;

    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    protected $dates = ['deleted_at'];

    protected $jsonable = ['images'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_itil';
}