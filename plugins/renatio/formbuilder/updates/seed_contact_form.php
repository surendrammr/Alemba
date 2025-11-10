<?php

namespace Renatio\FormBuilder\Updates;

use October\Rain\Database\Updates\Seeder;
use Renatio\FormBuilder\Models\Form;

class SeedContactForm extends Seeder
{
    public function run()
    {
        $form = $this->createForm();

        foreach ($this->fields() as $field) {
            $form->fields()->create([
                'field_type_id' => $field['type'],
                'label' => $field['label'],
                'name' => $field['name'],
                'wrapper_class' => $field['wrapper_class'],
                'validation_messages' => $field['validation_messages'] ?? null,
            ]);
        }
    }

    protected function createForm()
    {
        return Form::create([
            'template_code' => 'renatio.formbuilder::mail.contact',
            'name' => 'Contact Form',
            'description' => 'Renders a contact form.',
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
                'label' => 'Name',
                'placeholder' => 'Name',
                'name' => 'name',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 1,
                'label' => 'Subject',
                'name' => 'subject',
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
                'wrapper_class' => 'col-md-6',
            ],
            [
                'type' => 2,
                'label' => 'Message',
                'name' => 'content_message',
                'validation_messages' => [
                    [
                        'rule' => 'required',
                        'message' => '',
                    ],
                ],
                'wrapper_class' => 'col-md-12',
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
