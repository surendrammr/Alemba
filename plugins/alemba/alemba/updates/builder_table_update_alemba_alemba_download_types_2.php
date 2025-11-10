<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaDownloadTypes2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_download_types', function($table)
        {
            $table->renameColumn('download_type', 'name');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_download_types', function($table)
        {
            $table->renameColumn('name', 'download_type');
        });
    }
}
