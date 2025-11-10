<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaItil extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_itil', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('sort_order')->unsigned();
            $table->string('slug')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->text('benefits')->nullable();
            $table->text('provides')->nullable();
            $table->string('banner_image')->nullable();
            $table->text('images')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_itil');
    }
}
