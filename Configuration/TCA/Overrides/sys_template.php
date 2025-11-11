<?php
/*
file: Configuration/TCA/Overrides/sys_template.php
*/
declare(strict_types=1);
defined('TYPO3') or die('Access denied.');


defined('TYPO3') or die();

(static function (): void {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'container_package',
        'Configuration/TypoScript',
        'Container-Package'
    );
})();