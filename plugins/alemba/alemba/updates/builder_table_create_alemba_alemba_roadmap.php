<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaRoadmap extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_roadmap', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('status');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_roadmap');
    }
}
