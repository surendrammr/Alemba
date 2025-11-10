<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSubscribers4 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->boolean('customer');
            $table->boolean('prospect');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->dropColumn('customer');
            $table->dropColumn('prospect');
        });
    }
}
