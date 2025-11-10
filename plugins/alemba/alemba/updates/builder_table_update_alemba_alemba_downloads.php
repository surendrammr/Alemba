<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaDownloads extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_downloads', function($table)
        {
            $table->boolean('show_on_resources_page')->after('banner_title');
            $table->text('thumbnail')->after('show_on_resources_page')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_downloads', function($table)
        {
            $table->dropColumn('show_on_resources_page');
        });
    }
}
