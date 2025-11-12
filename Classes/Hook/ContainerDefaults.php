<?php
declare(strict_types=1);

namespace AndreasLoewer\ContainerPackage\Hook;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Automatically sets default FlexForm values for container CTypes
 * if no value has been stored yet.
 *
 * Why:
 * - The <default> tag in FlexForms only affects the backend form UI.
 * - The frontend rendering uses the persisted XML from pi_flexform.
 * - This hook writes missing defaults directly into the FlexForm XML.
 *
 * When:
 * - When creating a new record (ID starts with "NEW").
 * - When saving for the first time and the field is still empty.
 *
 * Scope:
 * - Only runs for tt_content and defined container CTypes.
 *
 * Customization:
 * - Add additional defaults in the “DEFAULTS” section.
 * - Extend the $allowed array for more CTypes.
 */
final class ContainerDefaults
{
    /**
     * DataHandler hook method executed before TYPO3 saves a record.
     *
     * @param array<string,mixed> $incoming  The field data to be saved (modifiable)
     * @param string              $table     Database table name, e.g. 'tt_content'
     * @param string|int          $id        Record UID or 'NEW...' for unsaved objects
     * @param DataHandler         $tceMain   The current DataHandler instance
     */
    public function processDatamap_preProcessFieldArray(
        array &$incoming,
        string $table,
        $id,
        DataHandler $tceMain
    ): void {
        // Only process tt_content records
        if ($table !== 'tt_content') {
            return;
        }

        // Determine the CType. It might not be in $incoming during updates.
        $cType = $incoming['CType']
            ?? ($tceMain->datamap['tt_content'][$id]['CType'] ?? null);

        // Restrict hook to container-related CTypes
        $allowed = [
            'container_section',
            'container_one_column',
            'container_two_columns',
            'container_three_columns',
            // Add more container CTypes here if needed
        ];
        if (!in_array($cType, $allowed, true)) {
            return;
        }

        // Detect new (unsaved) records
        $isNew = is_string($id) && str_starts_with($id, 'NEW');

        // Load and parse current FlexForm XML (create structure if missing)
        $xml = (string)($incoming['pi_flexform'] ?? '');
        $data = $xml ? (GeneralUtility::xml2array($xml) ?: []) : [];
        $data['data']['sDEF']['lDEF'] ??= [];
        $lDef =& $data['data']['sDEF']['lDEF'];

        // Check current value of classesRow
        $current = $lDef['classesRow']['vDEF'] ?? '';

        /**
         * DEFAULTS
         *
         * Rule:
         * - If new record OR value is empty, inject defaults.
         * - Never overwrite already saved values.
         *
         * Example defaults:
         * - classesRow = 'row' (Bootstrap row wrapper)
         * - Add more defaults below if needed
         */
        if ($isNew || $current === '') {
            $lDef['classesRow']['vDEF'] = 'row';
            // Example of additional defaults:
            // $lDef['classesCol']['vDEF']   = 'g-3';
            // $lDef['spacingTop']['vDEF']   = 'none';
            // $lDef['spacingBottom']['vDEF']= 'none';
        }

        // Convert back to XML so TYPO3 saves it
        $incoming['pi_flexform'] = GeneralUtility::array2xml(
            $data,
            '',            // no header comment
            0,             // indentation
            'T3FlexForms'  // root element
        );
    }
}
