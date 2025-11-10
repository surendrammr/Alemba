<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaOffices extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_offices', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('google')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->unsigned();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_offices');
    }
}
