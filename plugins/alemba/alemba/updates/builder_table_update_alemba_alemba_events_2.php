<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaEvents2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_events', function($table)
        {
            $table->string('location_type')->nullable()->after('location');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_events', function($table)
        {
            $table->dropColumn('location_type');
        });
    }
}