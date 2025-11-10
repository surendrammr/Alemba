<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Vacancy extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    
    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    protected $dates = ['deleted_at'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_vacancies';

    public $belongsTo = [
        'contact' => [
            'Alemba\Alemba\Models\Team',
            'order'      => 'name asc'
        ],
        'office' => [
            'Alemba\Alemba\Models\Office',
            'order'      => 'name asc'
        ]
    ];
}