<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaPress extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_press', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->string('publication')->nullable();
            $table->date('date')->nullable();
            $table->text('quote')->nullable();
            $table->text('text')->nullable();
            $table->string('download')->nullable();
            $table->string('badge')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_press');
    }
}
