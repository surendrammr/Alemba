<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaEvents extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_events', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('name_short')->nullable();
            $table->string('slug')->nullable();
            $table->string('full_dates')->nullable();
            $table->dateTime('startdate')->nullable();
            $table->dateTime('finishdate')->nullable();
            $table->boolean('featured')->nullable();
            $table->string('location')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('featured_heading')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('images')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_events');
    }
}
