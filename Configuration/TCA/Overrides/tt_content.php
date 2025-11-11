<?php
/*
file: Configuration/TCA/Overrides/tt_content.php
*/
declare(strict_types=1);

defined('TYPO3') or die();

use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ArrayUtility;

/**
 * Registriert einen Beispiel-Container "Dreispalter".
 * Passe identifier, CType, Labels, colPos und allowed CTypes an dein Projekt an.
 */
(static function (): void {
    $extensionKey = 'container_package';

    // 1) CType registrieren: Showitem, Icon, Paletten
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

    // 2) Container-Definition über b13/container
    /** @var Registry $registry */
    $registry = Registry::getInstance();

    $registry->configureContainer(
    // identifier (eindeutig im System)
        'container_three_columns',
        // Label (BE)
        'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:container_three_columns.title',
        // Beschreibung (BE)
        'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:container_three_columns.description',
        // Icon Identifier
        'content-container-3col',
        // CType
        'container_three_columns',
        // Felder, die im Form-Engine-Formular oben erscheinen dürfen
        [
            // typische Felder; erweitere bei Bedarf
            'header',
            'subheader',
            'records', // Render-Slot für Kinder; nicht entfernen
        ],
        // Spalten-Konfiguration
        [
            [
                'name' => 'left',
                'label' => 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:container_three_columns.col.left',
                'colPos' => 201,
                // optional: erlaubte CTypes einschränken
                // 'allowed' => ['text', 'textmedia', 'image']
            ],
            [
                'name' => 'middle',
                'label' => 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:container_three_columns.col.middle',
                'colPos' => 202,
            ],
            [
                'name' => 'right',
                'label' => 'LLL:EXT:' . $extensionKey . '/Resources/Private/Language/locallang_db.xlf:container_three_columns.col.right',
                'colPos' => 203,
            ],
        ]
    );
})();
