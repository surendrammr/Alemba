<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Download extends Model
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
    public $table = 'alemba_alemba_downloads';
    
    public $belongsToMany = [
        'category' => [
            'Alemba\Alemba\Models\DownloadTypes',
            'table' => 'alemba_alemba_category_downloads',
            'order' => 'name asc'
        ]
    ];
}