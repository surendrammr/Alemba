<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class PollAnswer extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /*
     * Validation
     */
    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_poll_answers';

    public $belongsTo = [
        'poll' => 'Alemba\Alemba\Models\Poll'
    ];
}