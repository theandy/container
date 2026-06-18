<?php
declare(strict_types=1);

namespace AndreasLoewer\ContainerPackage\DataHandler;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FlexFormDefaultsHook
{
    private const DEFAULTS = [
        'container_block' => [
            'classesContainer' => 'container',
        ],
        'container_one_column' => [
            'classesContainer' => 'container',
            'classesRow'       => 'row',
            'classesCol1'      => 'col',
        ],
        'container_two_columns' => [
            'classesContainer' => 'container',
            'classesRow'       => 'row',
            'classesCol1'      => 'col-md-6',
            'classesCol2'      => 'col-md-6',
        ],
        'container_three_columns' => [
            'classesContainer' => 'container',
            'classesRow'       => 'row',
            'classesCol1'      => 'col-md-4',
            'classesCol2'      => 'col-md-4',
            'classesCol3'      => 'col-md-4',
        ],
    ];

    public function processDatamap_preProcessFieldArray(
        array &$fieldArray,
        string $table,
        string|int $id,
        DataHandler $dataHandler
    ): void {
        if ($table !== 'tt_content') {
            return;
        }
        // Only act when no FlexForm data has been written yet
        if (!empty($fieldArray['pi_flexform'])) {
            return;
        }
        $ctype = $fieldArray['CType'] ?? '';
        $defaults = self::DEFAULTS[$ctype] ?? [];
        if (empty($defaults)) {
            return;
        }
        $fieldArray['pi_flexform'] = $this->buildFlexFormXml($defaults);
    }

    private function buildFlexFormXml(array $defaults): string
    {
        $data = ['data' => ['sDEF' => ['lDEF' => []]]];
        foreach ($defaults as $field => $value) {
            $data['data']['sDEF']['lDEF'][$field] = ['vDEF' => $value];
        }
        return '<?xml version="1.0" encoding="utf-8" standalone="yes" ?>' . "\n"
            . GeneralUtility::array2xml($data, '', 0, 'T3FlexForms', 4);
    }
}
