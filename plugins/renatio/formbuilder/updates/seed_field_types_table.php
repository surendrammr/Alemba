<?php

namespace Renatio\FormBuilder\Updates;

use Illuminate\Support\Facades\File;
use October\Rain\Database\Updates\Seeder;
use Renatio\FormBuilder\Models\FieldType;

class SeedFieldTypesTable extends Seeder
{
    public function run()
    {
        $path = __DIR__.'/fields/';

        FieldType::create([
            'name' => 'Text',
            'code' => 'text',
            'description' => 'Renders a single line text box.',
            'markup' => File::get($path.'_text.htm'),
        ]);

        FieldType::create([
            'name' => 'Textarea',
            'code' => 'textarea',
            'description' => 'Renders a multiline text box.',
            'markup' => File::get($path.'_textarea.htm'),
        ]);

        FieldType::create([
            'name' => 'Dropdown',
            'code' => 'dropdown',
            'description' => 'Renders a dropdown with specified options.',
            'markup' => File::get($path.'_dropdown.htm'),
        ]);

        FieldType::create([
            'name' => 'Checkbox',
            'code' => 'checkbox',
            'description' => 'Renders a single checkbox.',
            'markup' => File::get($path.'_checkbox.htm'),
        ]);

        FieldType::create([
            'name' => 'Checkbox List',
            'code' => 'checkbox_list',
            'description' => 'Renders a list of checkboxes.',
            'markup' => File::get($path.'_checkbox_list.htm'),
        ]);

        FieldType::create([
            'name' => 'Radio List',
            'code' => 'radio_list',
            'description' => 'Renders a list of radio options, where only one item can be selected at a time.',
            'markup' => File::get($path.'_radio_list.htm'),
        ]);

        FieldType::create([
            'name' => 'ReCaptcha',
            'code' => 'recaptcha',
            'description' => 'Renders a reCaptcha box.',
            'markup' => File::get($path.'_recaptcha.htm'),
        ]);

        FieldType::create([
            'name' => 'Submit',
            'code' => 'submit',
            'description' => 'Renders a submit button.',
            'markup' => File::get($path.'_submit.htm'),
        ]);

        FieldType::create([
            'name' => 'Country select',
            'code' => 'country_select',
            'description' => 'Renders a dropdown with country options.',
            'markup' => File::get($path.'_country_select.htm'),
        ]);

        FieldType::create([
            'name' => 'State select',
            'code' => 'state_select',
            'description' => 'Renders a dropdown with state options.',
            'markup' => File::get($path.'_state_select.htm'),
        ]);

        FieldType::create([
            'name' => 'File uploader',
            'code' => 'file_uploader',
            'description' => 'Renders a file uploader for regular files.',
        ]);

        FieldType::create([
            'name' => 'Image uploader',
            'code' => 'image_uploader',
            'description' => 'Renders a image uploader for image files.',
        ]);

        FieldType::create([
            'name' => 'Section',
            'code' => 'section',
            'description' => 'Renders a section heading and subheading.',
            'markup' => File::get($path.'_section.htm'),
        ]);

        FieldType::create([
            'name' => 'E-mail',
            'code' => 'email',
            'description' => 'Renders e-mail address field.',
            'markup' => File::get($path.'_email.htm'),
        ]);

        FieldType::create([
            'name' => 'Phone number',
            'code' => 'phone',
            'description' => 'Renders phone number field.',
            'markup' => File::get($path.'_phone.htm'),
        ]);

        FieldType::create([
            'name' => 'URL',
            'code' => 'url',
            'description' => 'Renders URL field.',
            'markup' => File::get($path.'_url.htm'),
        ]);

        FieldType::create([
            'name' => 'Numeric',
            'code' => 'numeric',
            'description' => 'Renders numeric field.',
            'markup' => File::get($path.'_numeric.htm'),
        ]);

        FieldType::create([
            'name' => 'Datetime',
            'code' => 'datetime',
            'description' => 'Renders datetime field.',
            'markup' => File::get($path.'_datetime.htm'),
        ]);

        FieldType::create([
            'name' => 'Date',
            'code' => 'date',
            'description' => 'Renders date field.',
            'markup' => File::get($path.'_date.htm'),
        ]);

        FieldType::create([
            'name' => 'Time',
            'code' => 'time',
            'description' => 'Renders time field.',
            'markup' => File::get($path.'_time.htm'),
        ]);

        FieldType::create([
            'name' => 'Color Picker',
            'code' => 'color_picker',
            'description' => 'Renders a color picker.',
            'markup' => File::get($path.'_color_picker.htm'),
        ]);
    }
}
