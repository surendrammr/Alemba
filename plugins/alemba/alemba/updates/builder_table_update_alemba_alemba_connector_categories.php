<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaConnectorCategories extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_connector_categories', function($table)
        {
            $table->text('description')->after('name')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_connector_categories', function($table)
        {
            $table->dropColumn('description');
        });
    }
}
