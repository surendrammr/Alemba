<?php

namespace Renatio\FormBuilder\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AddMarkupColumnToFormsTable extends Migration
{
    public function up()
    {
        Schema::table('renatio_formbuilder_forms', function (Blueprint $table) {
            $table->text('markup')->nullable();
            $table->boolean('has_floating_labels')->default(false);
        });
    }

    public function down()
    {
        Schema::table('renatio_formbuilder_forms', function (Blueprint $table) {
            $table->dropColumn(['markup', 'has_floating_labels']);
        });
    }
}
