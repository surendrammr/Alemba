<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaTeam extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_team', function($table)
        {
            $table->boolean('featured')->nullable()->default(0)->after('sort_order');
            $table->string('region')->nullable()->after('featured');
            $table->string('email')->nullable()->after('region');
            $table->integer('unique_number')->nullable()->after('email');
            $table->string('personal_image')->nullable()->after('unique_number');
            $table->string('personal_logo_orbs')->nullable()->after('personal_image');
            $table->string('personal_logo_black')->nullable()->after('personal_logo_orbs');
            $table->string('personal_logo_white')->nullable()->after('personal_logo_black');
            $table->string('brand_story')->nullable()->after('personal_logo_white');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_team', function($table)
        {
            $table->dropColumn('featured');
            $table->dropColumn('region');
            $table->dropColumn('email');
            $table->dropColumn('unique_number');
            $table->dropColumn('personal_image');
            $table->dropColumn('personal_logo_orbs');
            $table->dropColumn('personal_logo_black');
            $table->dropColumn('personal_logo_white');
            $table->dropColumn('brand_story');
        });
    }
}