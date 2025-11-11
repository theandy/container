<?php
declare(strict_types=1);

defined('TYPO3') or die();

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

(static function (): void {
    // Optional: Icon-Zuweisung im TCA (Registry setzt Icon ohnehin, diese Zeilen sind nicht zwingend)
    ArrayUtility::mergeRecursiveWithOverrule(
        $GLOBALS['TCA']['tt_content'],
        [
            'ctrl' => [
                'typeicon_classes' => [
                    'container_three_columns' => 'content-container-3col',
                ],
            ],
            'types' => [
                'container_three_columns' => [
                    'showitem' => '
                        --palette--;;general,
                        --palette--;;headers,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                        records,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:appearance,
                        --palette--;;frames,--palette--;;appearanceLinks,
                        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                        --palette--;;hidden,--palette--;;access
                    ',
                ],
            ],
        ]
    );

    // Container über Registry + ContainerConfiguration registrieren
    /** @var Registry $registry */
    $registry = GeneralUtility::makeInstance(Registry::class);

    $config = new ContainerConfiguration(
    // CType
        'container_three_columns',
        // Label
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.title',
        // Beschreibung
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.description',
        // Grid-Konfiguration: Array von Zeilen, jede Zeile enthält 1..n Spalten
        [
            [
                ['name' => 'left',   'colPos' => 201],
                ['name' => 'middle', 'colPos' => 202],
                ['name' => 'right',  'colPos' => 203],
            ],
        ]
    );

    // Optional: Icon-Identifier oder SVG-Pfad, Gruppe für Wizard, Defaultwerte
    $config
        ->setIcon('content-container-3col')     // nutzt den Icon-Identifier aus Configuration/Icons.php
        ->setGroup('containers')                // Reiter „Container“ im Wizard
        ->setRegisterInNewContentElementWizard(true);

    $registry->configureContainer($config);

    // PreviewRenderer registrieren
    $GLOBALS['TCA']['tt_content']['types']['container_three_columns']['previewRenderer']
        = \AndreasLoewer\ContainerPackage\Backend\Preview\ThreeColumnsPreview::class;
})();
