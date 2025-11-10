<?php namespace Alemba\BlogExtra\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class AddFieldsToPostsTable extends Migration
{

    public function up()
    {
        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->string('banner')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('title_short')->nullable();
            $table->string('author')->nullable();
            $table->string('featured_banner')->nullable();
            $table->string('featured_banner_heading')->nullable();
        });
    }

    public function down()
    {
        Schema::dropDown([
            'thumbnail',
            'title_short',
            'author',
            'featured_banner',
            'featured_banner_heading',
            'banner',
        ]);
    }

}
