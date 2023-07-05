<?php

use App\Registry\Feed\Item;

return [
    'min_chance_level' => Item::CHANCE_HIGH,
    'min_damage_level' => Item::DAMAGE_HIGH,
    // If the software is in the list add the item to the feed 
    // regardless of the chance and damage level
    'used_software' => [
        'mediawiki', 
        'elasticsearch',
        'mariadb', 
        'php',
        'redis', 
        'fuseki',
        'laravel', 
        'apache',
        'jenkins', 
        'postfix',
        'simplesamlphp',
        'annif',
        'jena', 
        'haproxy', 
        'varnish',
        'solr', 
        'drupal',
        'maxscale',
        'matomo',
        'grafana',
        'pandoc',
        'gitlab'
    ],
    'actions' => [
        'message_templates' => [
            'measure' => [
                'Not applicable',
                'We updated our software',
                'Contacted service provider',
                'Update pending at service provider'
            ],
            'impact' => [
                'No impact',
                'Impact at service provider',
                'Impacts our services'
            ]
        ]
    ],
    'api'=> [
        'auth_required' => true,
        'json'=> [
            'columns' => [ 'ncsc_id', 'updated_at', 'chance', 'damage', 'registration_id', 'title' ]
        ]
    ]
];