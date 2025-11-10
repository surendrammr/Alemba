<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSubscribers6 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->boolean('customer')->default(0)->change();
            $table->boolean('prospect')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->boolean('customer')->default(null)->change();
            $table->boolean('prospect')->default(null)->change();
        });
    }
}
