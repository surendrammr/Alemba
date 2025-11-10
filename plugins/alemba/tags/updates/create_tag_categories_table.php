<?php namespace Alemba\Tags\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTagsTagCategoriesTable Migration
 */
class CreateTagsTagCategoriesTable extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('alemba_tags_tag_categories', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('alemba_tags_tag_categories');
    }
};
