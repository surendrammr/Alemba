<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaCustomers extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_customers', function($table)
        {
            $table->boolean('featured')->default(0)->after('sector_id');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_customers', function($table)
        {
            $table->dropColumn('featured');
        });
    }
}
