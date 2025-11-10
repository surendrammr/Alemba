<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSuccessStories2 extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_success_stories', function($table)
        {
            $table->timestamp('published_at')->nullable()->after('video_poster');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_success_stories', function($table)
        {
            $table->dropColumn('published_at');
        });
    }
}