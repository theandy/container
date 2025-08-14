<?php
defined('TYPO3') or die();

// -----------------------------------
// 1. Konfiguration aller Container
// -----------------------------------
$iconPath = 'EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg';

$containers = [
    'section-container' => [
        'title' => 'Section',
        'desc'  => 'Insert a section element to group content.',
        'cols'  => [
            [['name' => 'Column', 'colPos' => 201]],
        ],
        'defaults' => [],
        'tcaFields' => [
            'tx_container_classes_section',
            'tx_container_bg_section',
        ],
    ],
    '1col-container' => [
        'title' => '1 Column Container',
        'desc'  => 'Insert a container element to group content.',
        'cols'  => [
            [['name' => 'Column', 'colPos' => 201]],
        ],
        'defaults' => ['tx_container_classes_col_1' => 'col-12'],
        'tcaFields' => [
            'tx_container_classes_container',
            'tx_container_classes_row',
            'tx_container_classes_col_1',
            'tx_container_bg_col_1',
        ],
    ],
    '2col-container' => [
        'title' => '2 Column Container',
        'desc'  => 'Insert a container element to divide content into two columns.',
        'cols'  => [
            [['name' => 'Left Column', 'colPos' => 201], ['name' => 'Right Column', 'colPos' => 202]],
        ],
        'defaults' => [
            'tx_container_classes_col_1' => 'col-lg-6',
            'tx_container_classes_col_2' => 'col-lg-6',
        ],
        'tcaFields' => [
            'tx_container_classes_container',
            'tx_container_classes_row',
            'tx_container_classes_col_1',
            'tx_container_bg_col_1',
            'tx_container_classes_col_2',
            'tx_container_bg_col_2',
        ],
    ],
    '3col-container' => [
        'title' => '3 Column Container',
        'desc'  => 'Insert a container element to divide content into three columns.',
        'cols'  => [
            [['name' => 'Left Column', 'colPos' => 201], ['name' => 'Middle Column', 'colPos' => 202], ['name' => 'Right Column', 'colPos' => 203]],
        ],
        'defaults' => [
            'tx_container_classes_col_1' => 'col-lg-4',
            'tx_container_classes_col_2' => 'col-lg-4',
            'tx_container_classes_col_3' => 'col-lg-4',
        ],
        'tcaFields' => [
            'tx_container_classes_container',
            'tx_container_classes_row',
            'tx_container_classes_col_1',
            'tx_container_classes_col_2',
            'tx_container_classes_col_3',
        ],
    ],
    '4col-container' => [
        'title' => '4 Column Container',
        'desc'  => 'Insert a container element to divide content into four columns.',
        'cols'  => [
            [
                ['name' => 'Column 1', 'colPos' => 201],
                ['name' => 'Column 2', 'colPos' => 202],
                ['name' => 'Column 3', 'colPos' => 203],
                ['name' => 'Column 4', 'colPos' => 204],
            ],
        ],
        'defaults' => [
            'tx_container_classes_col_1' => 'col-6 col-lg-3',
            'tx_container_classes_col_2' => 'col-6 col-lg-3',
            'tx_container_classes_col_3' => 'col-6 col-lg-3',
            'tx_container_classes_col_4' => 'col-6 col-lg-3',
        ],
        'tcaFields' => [
            'tx_container_classes_container',
            'tx_container_classes_row',
            'tx_container_classes_col_1',
            'tx_container_classes_col_2',
            'tx_container_classes_col_3',
            'tx_container_classes_col_4',
        ],
    ],
    '5col-container' => [
        'title' => '5 Column Container',
        'desc'  => 'Insert a container element to divide content into five columns.',
        'cols'  => [
            [
                ['name' => 'Column 1', 'colPos' => 201],
                ['name' => 'Column 2', 'colPos' => 202],
                ['name' => 'Column 3', 'colPos' => 203],
                ['name' => 'Column 4', 'colPos' => 204],
                ['name' => 'Column 5', 'colPos' => 205],
            ],
        ],
        'defaults' => [
            'tx_container_classes_col_1' => 'col-6 col-lg-3',
            'tx_container_classes_col_2' => 'col-6 col-lg-3',
            'tx_container_classes_col_3' => 'col-6 col-lg-3',
            'tx_container_classes_col_4' => 'col-6 col-lg-3',
        ],
        'tcaFields' => [
            'tx_container_classes_container',
            'tx_container_classes_row',
            'tx_container_classes_col_1',
            'tx_container_classes_col_2',
            'tx_container_classes_col_3',
            'tx_container_classes_col_4',
            'tx_container_classes_col_5',
        ],
    ],
    '6col-container' => [
        'title' => '6 Column Container',
        'desc'  => 'Insert a container element to divide content into six columns.',
        'cols'  => [
            [
                ['name' => 'Column 1', 'colPos' => 201],
                ['name' => 'Column 2', 'colPos' => 202],
                ['name' => 'Column 3', 'colPos' => 203],
                ['name' => 'Column 4', 'colPos' => 204],
                ['name' => 'Column 5', 'colPos' => 205],
                ['name' => 'Column 6', 'colPos' => 206],
            ],
        ],
        'defaults' => [
            'tx_container_classes_col_1' => 'col-6 col-lg-3',
            'tx_container_classes_col_2' => 'col-6 col-lg-3',
            'tx_container_classes_col_3' => 'col-6 col-lg-3',
            'tx_container_classes_col_4' => 'col-6 col-lg-3',
        ],
        'tcaFields' => [
            'tx_container_classes_container',
            'tx_container_classes_row',
            'tx_container_classes_col_1',
            'tx_container_classes_col_2',
            'tx_container_classes_col_3',
            'tx_container_classes_col_4',
            'tx_container_classes_col_5',
            'tx_container_classes_col_6',
        ],
    ],
];

// -----------------------------------
// 2. Container registrieren
// -----------------------------------
$registry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class);

foreach ($containers as $identifier => $data) {
    $config = (new \B13\Container\Tca\ContainerConfiguration(
        $identifier,
        $data['title'],
        $data['desc'],
        $data['cols']
    ))->setIcon($iconPath);

    if (!empty($data['defaults'])) {
        $config->setDefaultValues($data['defaults']);
    }

    $registry->configureContainer($config);
}

// -----------------------------------
// 3. Zusätzliche Felder definieren
// -----------------------------------
$temporaryColumn = [
    // Beispiel: nur ein Feld, hier würdest du alle deine tx_container_* Felder wie gehabt definieren
    'tx_container_classes_container' => [
        'exclude' => 0,
        'label' => 'Classes container',
        'config' => [
            'type' => 'input',
            'default' => 'container container-default'
        ],
    ],
    // ... hier weitere Felder definieren wie in deinem Originalcode ...
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumn);

// -----------------------------------
// 4. TCA showitem automatisch bauen
// -----------------------------------
$baseShowItem = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,
        bodytext,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
';

$languageAccessCats = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

foreach ($containers as $identifier => $data) {
    $customFields = '';
    if (!empty($data['tcaFields'])) {
        $fieldsList = implode(',', $data['tcaFields']);
        $customFields = '--div--;Custom container fields,' . $fieldsList . ',';
    }

    $GLOBALS['TCA']['tt_content']['types'][$identifier]['showitem'] =
        $baseShowItem .
        $customFields .
        $languageAccessCats;
}