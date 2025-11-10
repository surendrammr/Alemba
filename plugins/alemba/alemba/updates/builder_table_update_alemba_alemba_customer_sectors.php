<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaCustomerSectors extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_customer_sectors', function($table)
        {
            $table->string('slug')->nullable()->after('name');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_customer_sectors', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
