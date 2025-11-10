<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Subscriber extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    protected $appends = ['list_names'];

    public function getListNamesAttribute()
    {

        $string = '';

        $lists = $this->lists;

        if($lists) {

            $string = implode(', ', $lists->pluck('name')->toArray());

        }

        return $string;

    }

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_subscribers';

    public $belongsToMany = [
        'lists' => [
            'Alemba\Alemba\Models\NewsletterList', 'table' => 'alemba_alemba_list_subscribers'
        ]
    ];

    public $belongsTo = [
        'region' => ['Alemba\Alemba\Models\Region']
    ];
}