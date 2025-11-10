<?php namespace Alemba\Tags\Models;

use Model;

/**
 * ModelTag Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class ModelTag extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'alemba_tags_model_tags';

    /**
     * @var array rules for validation
     */
    public $rules = [];
}
