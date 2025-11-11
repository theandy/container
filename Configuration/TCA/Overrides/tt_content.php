<?php
declare(strict_types=1);

defined('TYPO3') or die();

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\GeneralUtility;

(static function (): void {
    /** @var Registry $registry */
    $registry = GeneralUtility::makeInstance(Registry::class);

    // Dreispalter
    $config = new ContainerConfiguration(
        'container_three_columns', // CType
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.title',
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.description',
        [
            [
                ['name' => 'left',   'colPos' => 201],
                ['name' => 'middle', 'colPos' => 202],
                ['name' => 'right',  'colPos' => 203],
            ],
        ]
    );

    // Icon + Wizard-Gruppe (Registry setzt auch showitem etc.)
    $config
        ->setIcon('content-container-3col')
        ->setGroup('containers')
        ->setRegisterInNewContentElementWizard(true);

    $registry->configureContainer($config);
})();
