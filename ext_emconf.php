<?php

/**
 * Extension Manager/Repository config file for ext "container_package".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'Container-Package',
    'description' => 'Adds container-support to TYPO3 installation',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.99.99',
            'fluid_styled_content' => '12.4.0-13.99.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'AndreasLoewer\\ContainerPackage\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Andreas Löwer',
    'author_email' => 'info@andreasloewer.de',
    'author_company' => 'Andreas Löwer',
    'version' => '1.0.0',
];