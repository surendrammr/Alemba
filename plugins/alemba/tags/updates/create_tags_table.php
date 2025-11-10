<?php namespace Alemba\Tags\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreateTagsTable Migration
 */
class CreateTagsTable extends Migration
{
    /**
     * up builds the migration
     */
    public function up()
    {
        Schema::create('alemba_tags_tags', function(Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * down reverses the migration
     */
    public function down()
    {
        Schema::dropIfExists('alemba_tags_tags');
    }
};
