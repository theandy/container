<?php
declare(strict_types=1);

defined('TYPO3') or die();

/**
 * Registers a DataHandler (TCEmain) hook.
 *
 * Background:
 * - FlexForm <default> only pre-fills the backend form field.
 * - The frontend, however, reads only the saved XML in pi_flexform.
 * - This hook injects missing default values into the FlexForm data
 *   before TYPO3 writes the record to the database.
 *
 * Hook slot:
 * - processDatamap_preProcessFieldArray: runs before the record is persisted.
 */
// ToDo!

(static function (): void {
    // Fallback nur für TYPO3 < 12: PageTS laden
    if (version_compare(\TYPO3\CMS\Core\Utility\VersionNumberUtility::getNumericTypo3Version(), '12.0.0', '<')) {
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            "@import 'EXT:container_package/Configuration/TsConfig/Page/All.tsconfig'"
        );
    }
})();
