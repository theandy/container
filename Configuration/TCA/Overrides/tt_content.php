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

    // Zentrale Definition aller Container
    $containers = [
        [
            'ctype' => 'container_one_column',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c1.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c1.desc',
            'grid'  => [[[ 'name' => 'content', 'colPos' => 201 ]]],
            'icon'  => 'content-container-1col',
            'group' => 'containers',
            'wizard'=> true,
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerCommon.xml',
        ],
        [
            'ctype' => 'container_two_columns',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c2.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c2.desc',
            'grid'  => [[
                [ 'name' => 'left',  'colPos' => 211 ],
                [ 'name' => 'right', 'colPos' => 212 ],
            ]],
            'icon'  => 'content-container-2col',
            'group' => 'containers',
            'wizard'=> true,
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerCommon.xml',
        ],
        [
            'ctype' => 'container_three_columns',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c3.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:c3.desc',
            'grid'  => [[
                [ 'name' => 'left',   'colPos' => 221 ],
                [ 'name' => 'middle', 'colPos' => 222 ],
                [ 'name' => 'right',  'colPos' => 223 ],
            ]],
            'icon'  => 'content-container-3col',
            'group' => 'containers',
            'wizard'=> true,
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerCommon.xml',
        ],
        [
            'ctype' => 'container_section',
            'label' => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:section.title',
            'desc'  => 'LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:section.desc',
            'grid'  => [[[ 'name' => 'section', 'colPos' => 231 ]]],
            'icon'  => 'content-container-section',
            'group' => 'containers',
            'wizard'=> true,
            'flex'  => 'FILE:EXT:container_package/Configuration/FlexForms/ContainerSection.xml',
        ],
    ];

    foreach ($containers as $c) {
        $config = new ContainerConfiguration($c['ctype'], $c['label'], $c['desc'], $c['grid']);
        $config->setIcon($c['icon'])->setGroup($c['group'])->setRegisterInNewContentElementWizard((bool)$c['wizard']);
        $registry->configureContainer($config);

        if (!empty($c['flex'])) {
            // derselbe FlexForm-File kann für mehrere CTypes verwendet werden
            ExtensionManagementUtility::addPiFlexFormValue('', $c['flex'], $c['ctype']);
            // in eigenen Tab „Container-Settings“ hängen
            ExtensionManagementUtility::addToAllTCAtypes(
                'tt_content',
                '--div--;LLL:EXT:container_package/Resources/Private/Language/locallang_db.xlf:tab.containerSettings,pi_flexform',
                $c['ctype']
            );
        }
    }
})();
