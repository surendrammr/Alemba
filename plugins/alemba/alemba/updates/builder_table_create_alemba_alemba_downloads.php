<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaDownloads extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_downloads', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->string('download');
            $table->string('type');
            $table->string('banner_pic')->nullable();
            $table->string('banner_title')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_downloads');
    }
}
