<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaEmployeeQuotes extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_employee_quotes', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('quote')->nullable();
            $table->string('employee')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_employee_quotes');
    }
}
