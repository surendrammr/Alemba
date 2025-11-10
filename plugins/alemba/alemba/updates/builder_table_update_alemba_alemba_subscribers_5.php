<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSubscribers5 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->string('referrer')->nullable();
            $table->string('telephone')->nullable();
            $table->string('jobtitle')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->dropColumn('referrer');
            $table->dropColumn('telephone');
            $table->dropColumn('jobtitle');
        });
    }
}
