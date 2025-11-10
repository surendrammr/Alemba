<?php namespace Alemba\BlogExtra\Models;

use Model;

/**
 * Blog Model
 */
class Blog extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'rainlab_blog_posts';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'post' => ['RainLab\Blog\Models\Post']
    ];

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

}