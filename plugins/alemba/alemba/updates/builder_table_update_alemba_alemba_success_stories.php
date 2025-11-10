<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateAlembaAlembaSuccessStories extends Migration
{
    public function up()
    {
        Schema::table('alemba_alemba_success_stories', function($table)
        {
            $table->string('video_mp4')->nullable()->after('thumbnail');
            $table->string('video_poster')->nullable()->after('video_mp4');
        });
    }
    
    public function down()
    {
        Schema::table('alemba_alemba_success_stories', function($table)
        {
            $table->dropColumn('video_mp4');
            $table->dropColumn('video_poster');
        });
    }
}
