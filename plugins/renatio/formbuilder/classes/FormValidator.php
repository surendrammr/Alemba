<?php

namespace Renatio\FormBuilder\Classes;

use Illuminate\Support\Facades\Validator;

class FormValidator
{
    protected $form;

    public function __construct($form)
    {
        $this->form = $form;
    }

    public function make()
    {
        return Validator::make(request()->all(), $this->rules(), $this->messages())
            ->setAttributeNames($this->names());
    }

    protected function rules()
    {
        return $this->form->fields
            ->filter(fn($field) => ! ! $field->validation_messages)
            ->lists('validation_messages.*.rule', 'name');
    }

    protected function messages()
    {
        return $this->form->fields
            ->filter(fn($field) => ! ! $field->validation_messages)
            ->map(fn($field) => $this->mapFieldToValidationMessages($field))
            ->collapse()
            ->all();
    }

    protected function names()
    {
        return $this->form->fields
            ->mapWithKeys(fn($field) => [$field->name => $field->label ?: ($field->placeholder ?: $field->name)])
            ->all();
    }

    protected function mapFieldToValidationMessages($field)
    {
        return collect($field->validation_messages)
            ->filter(fn($message) => $message['message'])
            ->mapWithKeys(fn($message) => [
                $field->name.'.'.array_first(explode(':', $message['rule'])) => $message['message'],
            ]);
    }
}
