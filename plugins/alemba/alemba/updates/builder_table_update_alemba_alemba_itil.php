<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaItil extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_itil', function($table)
        {
            $table->boolean('pink_verify')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_itil', function($table)
        {
            $table->dropColumn('pink_verify');
        });
    }
}
