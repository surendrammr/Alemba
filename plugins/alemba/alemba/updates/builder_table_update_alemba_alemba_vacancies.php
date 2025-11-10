<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaVacancies extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->integer('contact_id')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_vacancies', function($table)
        {
            $table->dropColumn('contact_id');
        });
    }
}
