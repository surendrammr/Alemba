<?php

namespace Renatio\SpamProtection\Components;

use Cms\Classes\ComponentBase;
use Spatie\Honeypot\Honeypot;

class SpamProtection extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'renatio.spamprotection::lang.component.name',
            'description' => 'renatio.spamprotection::lang.component.description',
        ];
    }

    public function init()
    {
        $honeypot = app(Honeypot::class);

        $this->page['nameFieldName'] = $honeypot->nameFieldName();
        $this->page['validFromFieldName'] = $honeypot->validFromFieldName();
        $this->page['encryptedValidFrom'] = $honeypot->encryptedValidFrom();
    }
}
