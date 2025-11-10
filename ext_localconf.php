<?php
defined('TYPO3') or die('Access denied.');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['drawItem'][]
    = \Vendor\Sitepackage\Backend\CeColorHook::class;



/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:container_package/Configuration/TsConfig/Page/All.tsconfig">');
