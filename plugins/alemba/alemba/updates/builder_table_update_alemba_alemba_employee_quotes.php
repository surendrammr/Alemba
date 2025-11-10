<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaEmployeeQuotes extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_employee_quotes', function($table)
        {
            $table->integer('sort_order');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_employee_quotes', function($table)
        {
            $table->dropColumn('sort_order');
        });
    }
}
