<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaDownloads3 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_downloads', function($table)
        {
            $table->string('type', 255)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_downloads', function($table)
        {
            $table->string('type', 255)->default('null')->change();
        });
    }
}
