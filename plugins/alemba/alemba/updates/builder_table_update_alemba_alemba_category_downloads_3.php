<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaCategoryDownloads3 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_category_downloads', function($table)
        {
            $table->renameColumn('downloads_id', 'download_id');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_category_downloads', function($table)
        {
            $table->renameColumn('download_id', 'downloads_id');
        });
    }
}
