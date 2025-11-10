<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaPartners extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_partners', function($table)
        {
            $table->integer('user_id')->nullable()->unsigned()->after('description');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_partners', function($table)
        {
            $table->dropColumn('user_id');
        });
    }
}
