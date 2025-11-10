<?php

namespace Renatio\FormBuilder\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddFileOptionsToFieldsTable extends Migration
{
    public function up()
    {
        Schema::table('renatio_formbuilder_fields', function (Blueprint $table) {
            $table->unsignedSmallInteger('max_size')->nullable();
            $table->string('file_types')->nullable();
            $table->unsignedSmallInteger('image_width')->nullable();
            $table->unsignedSmallInteger('image_height')->nullable();
            $table->string('image_mode')->nullable();
        });
    }

    public function down()
    {
        Schema::table('renatio_formbuilder_fields', function (Blueprint $table) {
            $table->dropColumn(['max_size', 'file_types', 'image_width', 'image_height', 'image_mode']);
        });
    }
}
