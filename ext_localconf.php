<?php
declare(strict_types=1);

defined('TYPO3') or die();

(static function (): void {
    // Fallback nur für TYPO3 < 12: PageTS laden
    if (version_compare(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version(), '12.0.0', '<')) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            "@import 'EXT:container_package/Configuration/TsConfig/Page/All.tsconfig'"
        );
    }
})();
