<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaVacancies5 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->integer('location_physical')->after('location');
            $table->integer('location_remote')->after('location_physical');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->dropColumn('location_physical');
            $table->dropColumn('location_remote');
        });
    }
}
