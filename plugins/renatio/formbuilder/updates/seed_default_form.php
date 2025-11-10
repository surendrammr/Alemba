<?php

namespace Renatio\FormBuilder\Updates;

use October\Rain\Database\Updates\Seeder;
use Renatio\FormBuilder\Models\Form;

class SeedDefaultForm extends Seeder
{
    public function run()
    {
        $form = $this->createForm();

        foreach ($this->fields() as $field) {
            $form->fields()->create([
                'field_type_id' => $field['type'],
                'label' => $field['label'],
                'name' => $field['name'],
                'options' => $field['options'] ?? null,
                'placeholder' => $field['placeholder'] ?? null,
                'validation_messages' => $field['validation_messages'] ?? null,
                'wrapper_class' => $field['wrapper_class'],
            ]);
        }
    }

    protected function createForm()
    {
        return Form::create([
            'template_code' => 'renatio.formbuilder::mail.default',
            'name' => 'Default Form',
            'description' => 'Renders a form with all available system fields.',
            'success_message' => e(trans('renatio.formbuilder::lang.message.success')),
            'error_message' => e(trans('renatio.formbuilder::lang.message.error')),
            'recipients' => [
                [
                    'email' => 'admin@domain.tld',
                    'recipient_name' => 'Admin Person',
                ],
            ],
            'css_class' => 'row g-3',
        ]);
    }

    protected function fields()
    {
        return [
            [
                'type' => 1,
                'label' => 'Text',
                'name' => 'text',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 14,
                'label' => 'E-mail',
                'name' => 'email',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                    [
                        'rule' => 'email',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 15,
                'label' => 'Phone',
                'name' => 'phone',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 16,
                'label' => 'URL',
                'name' => 'url',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 17,
                'label' => 'Numeric',
                'name' => 'numeric',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                    [
                        'rule' => 'numeric',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 18,
                'label' => 'Datetime',
                'name' => 'datetime',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 19,
                'label' => 'Date',
                'name' => 'date',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 20,
                'label' => 'Time',
                'name' => 'time',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 3,
                'label' => 'Dropdown',
                'name' => 'dropdown',
                'options' => [
                    '1' => [
                        'o_key' => 'option_1',
                        'o_label' => 'Option 1',
                    ],
                    '2' => [
                        'o_key' => 'option_2',
                        'o_label' => 'Option 2',
                    ],
                ],
                'placeholder' => '-- choose --',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-12',
            ],
            [
                'type' => 4,
                'label' => 'Checkbox',
                'name' => 'checkbox',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 21,
                'label' => 'Color picker',
                'name' => 'color',
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 5,
                'label' => 'Checkbox list',
                'name' => 'checkbox_list',
                'options' => [
                    '1' => [
                        'o_key' => 'checkbox_option_1',
                        'o_label' => 'Option 1',
                    ],
                    '2' => [
                        'o_key' => 'checkbox_option_2',
                        'o_label' => 'Option 2',
                    ],
                ],
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 6,
                'label' => 'Radio list',
                'name' => 'radio_list',
                'options' => [
                    '1' => [
                        'o_key' => 'radio_option_1',
                        'o_label' => 'Option 1',
                    ],
                    '2' => [
                        'o_key' => 'radio_option_2',
                        'o_label' => 'Option 2',
                    ],
                ],
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 9,
                'label' => 'Country select',
                'name' => 'country',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'placeholder' => '-- choose --',
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 10,
                'label' => 'State select',
                'name' => 'state',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'placeholder' => '-- choose --',
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 2,
                'label' => 'Textarea',
                'name' => 'textarea',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-12',
            ],
            [
                'type' => 13,
                'label' => 'Files Section',
                'name' => 'section',
                'wrapper_class' => 'col-md-12',
            ],
            [
                'type' => 11,
                'label' => 'File uploader',
                'name' => 'files',
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 12,
                'label' => 'Image uploader',
                'name' => 'images',
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 7,
                'label' => 'reCaptcha',
                'name' => 'g-recaptcha-response',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                    [
                        'rule' => 'recaptcha',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-12',
            ],
            [
                'type' => 8,
                'label' => 'Send',
                'name' => 'submit',
                'wrapper_class' => 'col-md-12 text-center',
            ],
        ];
    }
}
