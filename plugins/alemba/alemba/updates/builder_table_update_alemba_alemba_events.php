<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaEvents extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_events', function($table)
        {
            $table->integer('region_id')->nullable()->unsigned()->after('location');
            $table->string('banner_image_email')->nullable()->after('banner_image');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_events', function($table)
        {
            $table->dropColumn('region_id');
            $table->dropColumn('banner_image_email');
        });
    }
}
