<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class DownloadTypes extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_download_types';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
    
    public $belongsToMany = [
        'downloads' => [
            'Alemba\Alemba\Models\Download',
            'table' => 'alemba_alemba_category_downloads',
            'order' => 'name asc'
        ]
    ];
}
