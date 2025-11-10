<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaSuccessStories extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_success_stories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('slug')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->text('brief')->nullable();
            $table->text('reach')->nullable();
            $table->text('software')->nullable();
            $table->text('timeline')->nullable();
            $table->text('benefits')->nullable();
            $table->string('download')->nullable();
            $table->boolean('featured')->nullable();
            $table->string('home_image')->nullable();
            $table->text('home_quote')->nullable();
            $table->string('home_author')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('banner_heading')->nullable();
            $table->text('banner_quote')->nullable();
            $table->longText('sections')->nullable();
            $table->string('thumbnail')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_success_stories');
    }
}
