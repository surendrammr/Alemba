<?php

namespace Renatio\FormBuilder\Components;

use Cms\Classes\ComponentBase;
use October\Rain\Exception\AjaxException;
use October\Rain\Exception\ValidationException;
use Renatio\FormBuilder\Behaviors\FormUploader;
use Renatio\FormBuilder\Classes\FormValidator;
use Renatio\FormBuilder\Models\Form;
use Renatio\FormBuilder\Traits\SupportLocationFields;
use Renatio\SpamProtection\Components\SpamProtection;
use Throwable;

class RenderForm extends ComponentBase
{
    use SupportLocationFields;

    public $form;

    public $markup;

    public $message;

    public $messageType = 'danger';

    public $implement = [FormUploader::class];

    public function componentDetails()
    {
        return [
            'name' => 'renatio.formbuilder::lang.render_form.name',
            'description' => 'renatio.formbuilder::lang.render_form.description',
            'snippetAjax' => true
        ];
    }

    public function defineProperties()
    {
        return [
            'formCode' => [
                'title' => 'renatio.formbuilder::lang.form.title',
                'description' => 'renatio.formbuilder::lang.form.description',
                'type' => 'dropdown',
                'validation' => ['required' => true],
                'default' => 'default-form',
            ],
        ];
    }

    public function init()
    {
        try {
            $this->form = $this->getForm();

            $this->page['uploader_plugin_enabled'] = $this->asExtension('FormUploader')->init();

            $this->addComponent(SpamProtection::class, 'spamProtection', []);
        } catch (Throwable $throwable) {
            $this->page['formCode'] = $this->property('formCode');
        }
    }

    public function onRun()
    {
        $this->markup = $this->getFormMarkup();

        $this->addCss('assets/css/form.css?v=1');
        $this->addJs('assets/js/form.js?v=1');
    }

    public function onSubmit()
    {
        $validator = (new FormValidator($this->form))->make();

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        try {
            event('formBuilder.formSubmitted', [$this->form]);
        } catch (Throwable $throwable) {
            $this->message = app()->environment('production') ? $this->form->error_message : $throwable->getMessage();

            trace_log($throwable);

            throw new AjaxException([".form-alert-{$this->form->id}" => $this->renderPartial('@message')]);
        }

        return $this->response();
    }

    public function getFormCodeOptions()
    {
        return Form::lists('name', 'code');
    }

    protected function getForm()
    {
        return Form::query()
            ->with([
                'fields' => fn($query) => $query->isVisible()->with('field_type'),
            ])
            ->where('code', $this->property('formCode'))
            ->firstOrFail();
    }

    protected function response()
    {
        if ($this->form->redirect_to) {
            return redirect()->to($this->form->redirect_to);
        }

        $this->messageType = 'success';
        $this->message = $this->form->success_message;

        return [".form-alert-{$this->form->id}" => $this->renderPartial('@message')];
    }

    protected function getFormMarkup()
    {
        return $this->form?->fields->reduce(function ($template, $field) {
            $pattern = "/{{\sform_field\('$field->name'\)\s}}/i";

            if ($field->field_type->code == 'file_uploader') {
                return preg_replace($pattern, $this->renderPartial('@file_uploader', ['field' => $field]), $template);
            }

            if ($field->field_type->code == 'image_uploader') {
                return preg_replace($pattern, $this->renderPartial('@image_uploader', ['field' => $field]), $template);
            }

            return preg_replace($pattern, $field->html, $template);
        }, $this->form->getMarkup());
    }
}
