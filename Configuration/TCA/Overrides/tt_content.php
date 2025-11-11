<?php
declare(strict_types=1);

defined('TYPO3') or die();

use B13\Container\Tca\ContainerConfiguration;
use B13\Container\Tca\Registry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

(static function (): void {
    /** @var Registry $registry */
    $registry = GeneralUtility::makeInstance(Registry::class);

    // Container "Dreispalter"
    $config = new ContainerConfiguration(
        'container_three_columns',
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.title',
        'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:container_three_columns.description',
        [[
            ['name' => 'left',   'colPos' => 201],
            ['name' => 'middle', 'colPos' => 202],
            ['name' => 'right',  'colPos' => 203],
        ]]
    );

    $config
        ->setIcon('content-container-3col')
        ->setGroup('containers')
        ->setRegisterInNewContentElementWizard(true);

    $registry->configureContainer($config);

    // FlexForm-DS zuordnen (leer für list_type, CType als 3. Parameter)
    ExtensionManagementUtility::addPiFlexFormValue(
        '',
        'FILE:EXT:container_package/Configuration/FlexForms/ContainerThreeColumns.xml',
        'container_three_columns'
    );

    // FlexForm-Feld anhängen, ohne showitem zu überschreiben
    ExtensionManagementUtility::addToAllTCAtypes(
        'tt_content',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:plugin,pi_flexform',
        'container_three_columns',
        'after:subheader'
    );
})();
