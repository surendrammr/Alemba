<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaWhitepapers extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_whitepapers', function($table)
        {
            $table->boolean('live')->default(0);
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_whitepapers', function($table)
        {
            $table->dropColumn('live');
        });
    }
}
