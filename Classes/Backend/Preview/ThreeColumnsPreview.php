<?php
declare(strict_types=1);

defined('TYPO3') or die();

use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

(static function (): void {
    // … dein vorheriger $GLOBALS['TCA']-Merge bleibt unverändert …

    /** @var Registry $registry */
    $registry = GeneralUtility::makeInstance(Registry::class);

    $registry->configureContainer(
        'container_three_columns',
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.title',
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.description',
        'content-container-3col',
        'container_three_columns',
        [
            'header',
            'subheader',
            'records',
        ],
        [
            ['name' => 'left',   'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.col.left',   'colPos' => 201],
            ['name' => 'middle', 'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.col.middle', 'colPos' => 202],
            ['name' => 'right',  'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.col.right',  'colPos' => 203],
        ]
    );
})();
