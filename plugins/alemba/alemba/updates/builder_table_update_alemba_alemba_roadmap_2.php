<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaRoadmap2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_roadmap', function($table)
        {
            $table->renameColumn('name', 'feature');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_roadmap', function($table)
        {
            $table->renameColumn('feature', 'name');
        });
    }
}
