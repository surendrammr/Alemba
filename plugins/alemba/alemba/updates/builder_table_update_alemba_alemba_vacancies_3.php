<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaVacancies3 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->integer('office_id')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->dropColumn('office_id');
        });
    }
}
