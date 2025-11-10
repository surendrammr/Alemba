<?php
namespace Alemba\Search\Components;

use Cms\Classes\ComponentBase;

class SearchMeta extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Search Metadata',
            'description' => 'Controls how this page is indexed by Algolia search',
        ];
    }

    public function defineProperties()
    {
        return [
            'exclude' => [
                'title'       => 'Exclude from search',
                'type'        => 'checkbox',
                'default'     => false,
                'description' => 'Prevent this page from being indexed',
            ],
            'tags' => [
                'title'       => 'Search Tags',
                'type'        => 'string',
                'default'     => '',
                'description' => 'Comma-separated list of additional tags or keywords',
            ],
            'priority' => [
                'title'       => 'Search Priority',
                'type'        => 'dropdown',
                'default'     => '0',
                'description' => 'Relative priority for search ranking',
                'options'     => [
                    '-2' => 'Very Low',
                    '-1' => 'Low',
                    '0'  => 'Normal',
                    '1'  => 'High',
                    '2'  => 'Very High',
                ],
            ],
        ];
    }
}