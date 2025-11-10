<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaTeam2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_team', function($table)
        {
            $table->text('address')->after('email')->nullable();
            $table->string('tel')->after('address')->nullable();
            $table->string('fax')->after('tel')->nullable();
            $table->string('mobile')->after('fax')->nullable();
            $table->integer('office_id')->after('mobile')->nullable()->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_team', function($table)
        {
            $table->dropColumn('address');
            $table->dropColumn('tel');
            $table->dropColumn('fax');
            $table->dropColumn('mobile');
        });
    }
}
