<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSubscribers2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->string('country', 255)->nullable();
            $table->dateTime('optin_at');
            $table->unique('email');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->dropColumn('country');
            $table->dropColumn('optin_at');
            $table->dropIndex('email');
        });
    }
}
