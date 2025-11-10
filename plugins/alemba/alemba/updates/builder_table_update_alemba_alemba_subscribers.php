<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSubscribers extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->integer('region_id')->unsigned();
            $table->string('region_name');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->dropColumn('region_id');
            $table->dropColumn('region_name');
        });
    }
}
