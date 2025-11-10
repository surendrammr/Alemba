<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaReleases extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_releases', function($table)
        {
            $table->string('version_number')->after('name');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_releases', function($table)
        {
            $table->dropColumn('version_number');
        });
    }
}