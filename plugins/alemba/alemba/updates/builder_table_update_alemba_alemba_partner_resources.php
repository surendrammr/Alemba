<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaPartnerResources extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_partner_resources', function($table)
        {
            $table->string('thumbnail')->nullable()->after('type');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_partner_resources', function($table)
        {
            $table->dropColumn('thumbnail');
        });
    }
}
