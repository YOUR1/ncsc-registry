<?php

use App\Registry\Feed\Item;

return [
    'min_chance_level' => Item::CHANCE_HIGH,
    'min_damage_level' => Item::DAMAGE_HIGH,
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
        'auth_required' => false,
        'json'=> [
            'columns' => [ 'ncsc_id', 'updated_at', 'chance', 'damage', 'registration_id' ]
        ]
    ]
];