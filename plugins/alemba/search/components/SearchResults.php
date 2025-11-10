<?php
namespace Alemba\Search\Components;

use Cms\Classes\ComponentBase;
use Algolia\AlgoliaSearch\SearchClient;
use Alemba\Search\Models\Settings;

class SearchResults extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Search Results',
            'description' => 'Displays Algolia search results'
        ];
    }

    public function defineProperties()
    {
        return [
            'query' => [
                'title'       => 'Query',
                'description' => 'Search query string',
                'type'        => 'string',
                'default'     => '{{ :query }}',
            ],
            'index' => [
                'title'       => 'Index Name',
                'description' => 'The Algolia index to search',
                'type'        => 'string',
                'default'     => 'cms_pages'
            ]
        ];
    }

    public function onRun()
    {
        $query = $this->property('query');
        $indexName = $this->property('index');

        $appId = Settings::get('algolia_app_id');
        $apiKey = Settings::get('algolia_api_key');

        if (!$query || !$appId || !$apiKey) {
            $this->page['results'] = [];
            return;
        }

        $client = SearchClient::create($appId, $apiKey);
        $index = $client->initIndex($indexName);
        $results = $index->search($query);

        $this->page['results'] = $results['hits'] ?? [];
    }
}
