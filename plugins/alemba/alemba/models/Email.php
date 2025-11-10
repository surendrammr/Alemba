<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class Email extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_emails';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function getPreviewAttribute()
    {

        return $this->body;

    }

    public $belongsToMany = [
        'recipients' => ['Alemba\Alemba\Models\Team', 'table' => 'alemba_alemba_emails_team', 'order' => 'name asc']
    ];

}
