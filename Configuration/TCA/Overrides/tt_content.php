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

    // Backend-only column selector for container_block
    $GLOBALS['TCA']['tt_content']['columns']['tx_container_package_be_cols'] = [
        'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:be_cols.label',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'default' => 1,
            'items' => [
                ['label' => '1', 'value' => 1],
                ['label' => '2', 'value' => 2],
                ['label' => '3', 'value' => 3],
                ['label' => '4', 'value' => 4],
                ['label' => '5', 'value' => 5],
                ['label' => '6', 'value' => 6],
            ],
        ],
    ];

    // Zentrale Definition aller Container
    $containers = [
        [
            'ctype' => 'container_block',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:block.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:block.desc',
            'grid'  => [[['name' => 'content', 'colPos' => 241]]],
            'icon'  => 'content-container-block',
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerBlock.xml',
            'backendTemplate' => 'EXT:container_package/Resources/Private/Templates/Backend/Container.html',
        ],
        [
            'ctype' => 'container_one_column',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c1.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c1.desc',
            'grid'  => [[['name' => 'content', 'colPos' => 201]]],
            'icon'  => 'content-container-1col',
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerCommon_1col.xml',
        ],
        [
            'ctype' => 'container_two_columns',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c2.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c2.desc',
            'grid'  => [[
                ['name' => 'left',  'colPos' => 211],
                ['name' => 'right', 'colPos' => 212],
            ]],
            'icon'  => 'content-container-2col',
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerCommon_2col.xml',
        ],
        [
            'ctype' => 'container_three_columns',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c3.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c3.desc',
            'grid'  => [[
                ['name' => 'left',   'colPos' => 221],
                ['name' => 'middle', 'colPos' => 222],
                ['name' => 'right',  'colPos' => 223],
            ]],
            'icon'  => 'content-container-3col',
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerCommon_3col.xml',
        ],
        [
            'ctype' => 'container_section',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:section.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:section.desc',
            'grid'  => [[['name' => 'section', 'colPos' => 231]]],
            'icon'  => 'content-container-section',
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerSection.xml',
        ],
    ];

    foreach ($containers as $c) {
        $config = new ContainerConfiguration($c['ctype'], $c['label'], $c['desc'], $c['grid']);
        $config->setIcon($c['icon'])->setGroup('containers')->setRegisterInNewContentElementWizard(true);
        if (!empty($c['backendTemplate'])) {
            $config->setBackendTemplate($c['backendTemplate']);
        }
        $registry->configureContainer($config);

        ExtensionManagementUtility::addPiFlexFormValue('', $c['flex'], $c['ctype']);

        $tabFields = $c['ctype'] === 'container_block'
            ? 'tx_container_package_be_cols,pi_flexform'
            : 'pi_flexform';

        ExtensionManagementUtility::addToAllTCAtypes(
            'tt_content',
            '--div--;LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:tab.containerSettings,' . $tabFields,
            $c['ctype']
        );
    }
})();
