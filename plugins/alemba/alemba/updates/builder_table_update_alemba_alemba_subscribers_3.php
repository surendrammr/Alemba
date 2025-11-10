<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSubscribers3 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->string('name', 255)->nullable()->change();
            $table->string('company', 255)->nullable()->change();
            $table->integer('region_id')->nullable()->change();
            $table->string('region_name', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_subscribers', function($table)
        {
            $table->string('name', 255)->nullable(false)->change();
            $table->string('company', 255)->nullable(false)->change();
            $table->integer('region_id')->nullable(false)->change();
            $table->string('region_name', 255)->nullable(false)->change();
        });
    }
}
