<?php namespace Alemba\Search\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * AddSearchFieldsToBlogPostsTable Migration
 *
 * @link https://docs.octobercms.com/3.x/extend/database/structure.html
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            $table->boolean('exclude_from_search')->default(false);
            $table->string('search_tags')->nullable();
            $table->integer('search_priority')->default(0);
        });
    }

    public function down()
    {
        Schema::table('rainlab_blog_posts', function ($table) {
            $table->dropColumn(['exclude_from_search', 'search_tags', 'search_priority']);
        });
    }
};
