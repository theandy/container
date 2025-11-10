<?php
defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$fields = [
    'tx_backend_bgcolor' => [
        'label' => 'Hintergrundfarbe (nur Backend)',
        'exclude' => 0, // zum Testen 0, später 1 + Rechte setzen
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
            'eval' => 'trim',
            'size' => 10,
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

$containerTypes = [
    '1col-container',
    '2col-container',
    '3col-container',
    // ggf. weitere hier ergänzen
];

ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'tx_backend_bgcolor',
    implode(',', $containerTypes),
    'after:header'
);
