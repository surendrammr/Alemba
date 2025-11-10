<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaDownloadTypes extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_download_types', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 255)->default('null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_download_types');
    }
}
