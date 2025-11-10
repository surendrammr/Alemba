<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaCategoryDownloads extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_category_downloads', function($table)
        {
            $table->renameColumn('download_type_id', 'download_types_id');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_category_downloads', function($table)
        {
            $table->renameColumn('download_types_id', 'download_type_id');
        });
    }
}
