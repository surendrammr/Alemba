<?php

namespace Renatio\FormBuilder\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Renatio\FormBuilder\Models\FieldType;
use Schema;

class AddIsDefaultColumnToFieldTypesTable extends Migration
{
    public function up()
    {
        Schema::table('renatio_formbuilder_field_types', function (Blueprint $table) {
            $table->boolean('is_default')->default(false);
        });

        FieldType::query()
            ->whereIn('code', [
                'checkbox',
                'checkbox_list',
                'country_select',
                'dropdown',
                'radio_list',
                'recaptcha',
                'section',
                'state_select',
                'submit',
                'text',
                'email',
                'phone',
                'numeric',
                'url',
                'datetime',
                'date',
                'time',
                'color_picker',
                'textarea',
                'file_uploader',
                'image_uploader',
            ])
            ->update(['is_default' => true]);
    }

    public function down()
    {
        Schema::table('renatio_formbuilder_field_types', function (Blueprint $table) {
            $table->dropColumn('is_default');
        });
    }
}
