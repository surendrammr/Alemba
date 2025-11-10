<?php

namespace Renatio\FormBuilder\Models;

use Backend\Models\ImportModel;
use Carbon\Carbon;

class FormImport extends ImportModel
{
    public $table = 'renatio_formbuilder_forms';

    public $rules = [
        'name' => ['required'],
        'code' => ['required'],
    ];

    protected $jsonable = ['recipients', 'cc_recipients', 'bcc_recipients'];

    public function importData($results, $sessionKey = null)
    {
        foreach ($results as $row => $data) {
            try {
                $form = Form::where('code', array_get($data, 'code'))->first() ?? Form::make();

                $exists = $form->exists;

                foreach (array_except($data, ['id', 'fields']) as $attribute => $value) {
                    if (in_array($attribute, ['created_at', 'updated_at'])) {
                        $form->$attribute = Carbon::parse($value);
                    } elseif (in_array($attribute, $this->jsonable)) {
                        $form->$attribute = json_decode($value);
                    } else {
                        $form->$attribute = $value;
                    }
                }

                $form->forceSave();

                if ($data['fields']) {
                    $this->createFormFields($form, $data['fields']);
                }

                if ($exists) {
                    $this->logUpdated();
                } else {
                    $this->logCreated();
                }
            } catch (\Exception $ex) {
                $this->logError($row, $ex->getMessage());
            }
        }
    }

    protected function createFormFields($form, $fields)
    {
        Field::unguard();

        foreach ($fields as $field) {
            $form->fields()->create(array_except($field, ['id', 'form_id', 'created_at', 'updated_at']));
        }
    }
}
