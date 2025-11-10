<?php

defined('TYPO3') or die();

$fields = [
    'tx_backend_bgcolor' => [
        'label' => 'Hintergrundfarbe (nur Backend)',
        'exclude' => 1,
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
            'eval' => 'trim',
        ],
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

// deine Container-CTypes eintragen
$containerTypes = ['container_2col','container_3col'];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'tx_backend_bgcolor',
    implode(',', $containerTypes),
    'after:header'
);
