<?php

$EM_CONF['beuser_iprange'] = [
    'title' => 'IP-range for Admins/Be-user',
    'description' => 'restrict BE-user to IP-range',
    'category' => 'services',
    'version' => '6.0.2',
    'state' => 'stable',
    'clearcacheonload' => 1,
    'author' => 'Steffen Kamper, Simon Schmidt, Eike Drost',
    'author_email' => 'typo3@marketing-factory.de',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
