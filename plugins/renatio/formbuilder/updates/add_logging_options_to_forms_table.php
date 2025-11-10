<?php

namespace Renatio\FormBuilder\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddLoggingOptionsToFormsTable extends Migration
{
    public function up()
    {
        Schema::table('renatio_formbuilder_forms', function (Blueprint $table) {
            $table->boolean('is_log_enabled')->default(true);
            $table->boolean('is_autoresponder_log_enabled')->default(true);
        });
    }

    public function down()
    {
        Schema::table('renatio_formbuilder_forms', function (Blueprint $table) {
            $table->dropColumn('is_log_enabled');
            $table->dropColumn('is_autoresponder_log_enabled');
        });
    }
}
