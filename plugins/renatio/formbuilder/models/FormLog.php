<?php

namespace Renatio\FormBuilder\Models;

use Illuminate\Database\Eloquent\MassPrunable;
use October\Rain\Database\Model;

class FormLog extends Model
{
    use MassPrunable;

    public $table = 'renatio_formbuilder_form_logs';

    protected $jsonable = ['form_data'];

    public $belongsTo = [
        'form' => Form::class,
    ];

    public function afterDelete()
    {
        if (! $this->form) {
            return;
        }

        $this->form->attachLogRelations($this);

        foreach ($this->form->uploadFields() as $field) {
            $this->{$field->name}->each->delete();
        }
    }

    public function log($form)
    {
        $this->form_id = $form->id;
        $this->form_data = $form->getData();

        $this->save(null, post('_session_key'));
    }

    public function prunable()
    {
        if (! ($prunePeriod = (int) Settings::get('prune_logs_period'))) {
            exit;
        }

        return static::where('created_at', '<=', now()->subDays($prunePeriod));
    }
}
