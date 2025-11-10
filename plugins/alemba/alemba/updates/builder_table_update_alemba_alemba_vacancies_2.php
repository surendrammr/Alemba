<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaVacancies2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->string('icon')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->dropColumn('icon');
        });
    }
}
