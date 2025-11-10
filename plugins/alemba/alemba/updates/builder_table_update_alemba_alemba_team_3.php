<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaTeam3 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_team', function($table)
        {
            $table->string('skype')->nullable()->after('mobile');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_team', function($table)
        {
            $table->dropColumn('skype');
        });
    }
}
