<?php namespace Alemba\Alemba\Models;

use Model;

/**
 * Model
 */
class SuccessStory extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    
    public $implement = ['@Renatio.SeoManager.Behaviors.SeoModel'];

    protected $dates = ['deleted_at'];

    protected $jsonable = ['sections'];

    /*
     * Validation
     */
    public $rules = [
    ];

    public $belongsTo = [
        'customer' => \Alemba\Alemba\Models\Customer::class
    ];

    public function getResourceAttribute()
    {
        $array = [
            'title' => $this->customer->name,
            'text' => $this->meta_description,
            'thumbnail' => $this->thumbnail,
            'url' => $this->canonical_url,
            'type' => 'Success Story'
        ];

        return $array;
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public $morphToMany = [
        'tags' => [
            'Alemba\Tags\Models\Tag',
            'table'      => 'alemba_tags_tag_taggables', // Custom pivot table
            'name'       => 'taggable',
            'foreignKey' => 'taggable_id',
            'otherKey'   => 'tag_id',
        ]
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'alemba_alemba_success_stories';
}