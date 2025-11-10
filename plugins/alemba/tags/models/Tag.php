<?php namespace Alemba\Tags\Models;

use Model;

/**
 * Tag Model
 *
 * @link https://docs.octobercms.com/3.x/extend/system/models.html
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table name
     */
    public $table = 'alemba_tags_tags';

    /**
     * @var array rules for validation
     */
    public $rules = [];

    public $belongsTo = [
        'category' => \Alemba\Tags\Models\TagCategory::class
    ];

    public $morphedByMany = [
        'posts'  => [\RainLab\Blog\Models\Post::class, 'table' => 'alemba_tags_tag_taggables', 'name' => 'taggable'],
        'successStories' => [\Alemba\Alemba\Models\SuccessStory::class, 'table' => 'alemba_tags_tag_taggables', 'name' => 'taggable']
    ];
}
