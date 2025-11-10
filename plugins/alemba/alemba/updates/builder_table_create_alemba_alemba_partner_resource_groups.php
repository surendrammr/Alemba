<?php namespace Alemba\Alemba\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateAlembaAlembaPartnerResourceGroups extends Migration
{
    public function up()
    {
        Schema::create('alemba_alemba_partner_resource_groups', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('sort_order')->unsigned()->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('alemba_alemba_partner_resource_groups');
    }
}
