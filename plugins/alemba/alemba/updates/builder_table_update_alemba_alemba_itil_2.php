<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaItil2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_itil', function($table)
        {
            $table->string('icon')->nullable()->after('banner_image');
            $table->boolean('itil')->default(0)->after('images');
            $table->string('page')->nullable()->after('itil');
            $table->integer('sort_order')->default(0)->change();
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_itil', function($table)
        {
            $table->dropColumn('icon');
            $table->dropColumn('itil');
            $table->dropColumn('page');
            $table->integer('sort_order')->default(null)->change();
        });
    }
}