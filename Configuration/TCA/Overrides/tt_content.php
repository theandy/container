<?php

defined('TYPO3') or die();

$fields = [
    'tx_backend_bgcolor' => [
        'label' => 'Hintergrundfarbe (nur Backend)',
        'exclude' => 0, // zum Testen auf 0, später ggf. 1 + Rechte vergeben
        'config' => [
            'type' => 'input',
            'renderType' => 'colorpicker',
            'eval' => 'trim',
            'size' => 10,
        ],
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $fields);

// nur beim Container-Datensatz anzeigen
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'tx_backend_bgcolor',
    'container',
    'after:header'
);
