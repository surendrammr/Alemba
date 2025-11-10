<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaEmailsTeam extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_emails_team', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->integer('email_id')->unsigned();
            $table->dateTime('sent');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_emails_team');
    }
}
