<?php
defined('TYPO3') or die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\B13\Container\Backend\Preview\ContainerPreviewRenderer::class] = [
    'className' => \AndreasLoewer\ContainerPackage\Backend\Xclass\ContainerPreviewRenderer::class,
];

/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:container_package/Configuration/TsConfig/Page/All.tsconfig">');
