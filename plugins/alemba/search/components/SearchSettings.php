<?php
namespace Alemba\Search\Components;

use Cms\Classes\ComponentBase;
use Alemba\Search\Models\Settings;

class SearchSettings extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Search Settings',
            'description' => 'Exposes Algolia search settings to Twig'
        ];
    }

    public function onRun()
    {
        $this->page['algoliaAppId'] = Settings::get('algolia_app_id');
        $this->page['algoliaApiKey'] = Settings::get('algolia_api_key');
        $this->page['algoliaSearchKey'] = Settings::get('algolia_search_key');
    }
}