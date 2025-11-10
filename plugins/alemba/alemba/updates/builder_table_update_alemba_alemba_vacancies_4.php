<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaVacancies4 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->string('application_url')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->dropColumn('application_url');
        });
    }
}
