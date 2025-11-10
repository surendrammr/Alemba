<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaWhitepapers extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_whitepapers', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->text('intro')->nullable();
            $table->text('text')->nullable();
            $table->string('download', 255)->nullable();
            $table->string('banner_image', 255)->nullable();
            $table->string('thumbnail', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_whitepapers');
    }
}
