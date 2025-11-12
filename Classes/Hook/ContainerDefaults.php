<?php
declare(strict_types=1);

namespace AndreasLoewer\ContainerPackage\Hook;

use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Log\LogManager;

final class ContainerDefaults
{
    /** @var string[] */
    private array $allowedCTypes = [
        'container_section',
        'container_one_column',
        'container_two_columns',
        'container_three_columns',
    ];

    public function processDatamap_preProcessFieldArray(
        array &$incomingFieldArray,
        string $table,
        $id,
        DataHandler $dataHandler
    ): void {
        if ($table !== 'tt_content') {
            return;
        }

        $cType = $incomingFieldArray['CType']
            ?? $this->getCurrentCType((string)$id)
            ?? ($dataHandler->datamap['tt_content'][$id]['CType'] ?? null);

        if (!is_string($cType) || !in_array($cType, $this->allowedCTypes, true)) {
            return;
        }

        $isNew = is_string($id) && str_starts_with($id, 'NEW');

        // --- ROBUST: FlexForm XML sicher parsen + Struktur garantieren ---
        $xml = (string)($incomingFieldArray['pi_flexform'] ?? '');
        $data = $this->normalizeFlexForm($xml);
        $lDef =& $data['data']['sDEF']['lDEF'];

        $current = is_array($lDef['classesRow'] ?? null)
            ? (string)($lDef['classesRow']['vDEF'] ?? '')
            : '';

        if ($isNew || $current === '') {
            $lDef['classesRow']['vDEF'] = 'row';
            // weitere Defaults:
            // $lDef['classesCol']['vDEF']    = 'g-3';
            // $lDef['spacingTop']['vDEF']    = 'none';
            // $lDef['spacingBottom']['vDEF'] = 'none';
        }

        $incomingFieldArray['pi_flexform'] = GeneralUtility::array2xml(
            $data,
            '',
            0,
            'T3FlexForms'
        );

        $this->logger()->info('FlexForm defaults applied', [
            'id' => $id,
            'ctype' => $cType,
            'isNew' => $isNew,
        ]);
    }

    /** Normalisiert das FlexForm-XML zu einer gültigen Array-Struktur. */
    private function normalizeFlexForm(string $xml): array
    {
        $parsed = $xml !== '' ? GeneralUtility::xml2array($xml) : null;

        // Nur akzeptieren, wenn wirklich ein Array zurückkam
        $data = is_array($parsed) ? $parsed : [];

        // Grundstruktur hart sicherstellen
        if (!isset($data['data']) || !is_array($data['data'])) {
            $data['data'] = [];
        }
        if (!isset($data['data']['sDEF']) || !is_array($data['data']['sDEF'])) {
            $data['data']['sDEF'] = [];
        }
        if (!isset($data['data']['sDEF']['lDEF']) || !is_array($data['data']['sDEF']['lDEF'])) {
            $data['data']['sDEF']['lDEF'] = [];
        }

        return $data;
    }

    private function getCurrentCType(string $id): ?string
    {
        if (!MathUtility::canBeInterpretedAsInteger($id)) {
            return null;
        }
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tt_content');

        $row = $connection->select(['CType'], 'tt_content', ['uid' => (int)$id])->fetchAssociative();
        return $row['CType'] ?? null;
    }

    private function logger()
    {
        return GeneralUtility::makeInstance(LogManager::class)
            ->getLogger(__CLASS__);
    }
}
