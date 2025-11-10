<?php namespace Alemba\Tags\Models;

use Model;

/**
 * TagCategory Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class TagCategory extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'alemba_tags_tag_categories';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $hasMany = [
        'tags' => [\Alemba\Tags\Models\Tag::class, 'key' => 'category_id', 'otherKey' => 'id']
    ];
}
