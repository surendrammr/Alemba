<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaEvents3 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_events', function($table)
        {
            $table->string('registration_url')->nullable()->after('location_type');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_events', function($table)
        {
            $table->dropColumn('registration_url');
        });
    }
}
