<?php namespace Alemba\Tags\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTagTaggablesTable Migration
 */
class CreateTagTaggablesTable extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('alemba_tags_tag_taggables', function(Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('alemba_tags_tags')->onDelete('cascade');
            $table->morphs('taggable'); // Creates `taggable_id` & `taggable_type`
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('alemba_tags_tag_taggables');
    }
};
