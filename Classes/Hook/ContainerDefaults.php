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
        // ggf. weitere CTypes ergänzen
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

        // CType ermitteln: bevorzugt aus $incoming, sonst aus aktueller DB, sonst aus Datamap
        $cType = $incomingFieldArray['CType']
            ?? $this->getCurrentCType((string)$id)
            ?? ($dataHandler->datamap['tt_content'][$id]['CType'] ?? null);

        if (!is_string($cType) || !in_array($cType, $this->allowedCTypes, true)) {
            return;
        }

        // Neu = "NEW..." (vor Persist), Alt = numerische UID
        $isNew = is_string($id) && str_starts_with($id, 'NEW');

        // FlexForm laden oder Grundstruktur erzeugen
        $xml = (string)($incomingFieldArray['pi_flexform'] ?? '');
        $data = $xml ? (GeneralUtility::xml2array($xml) ?: []) : [];
        $data['data']['sDEF']['lDEF'] ??= [];
        $lDef =& $data['data']['sDEF']['lDEF'];

        // Aktuellen Wert lesen
        $current = $lDef['classesRow']['vDEF'] ?? '';

        // Default nur setzen, wenn neu oder leer
        if ($isNew || $current === '') {
            $lDef['classesRow']['vDEF'] = 'row';
            // weitere Defaults bei Bedarf:
            // $lDef['classesCol']['vDEF']    = 'g-3';
            // $lDef['spacingTop']['vDEF']    = 'none';
            // $lDef['spacingBottom']['vDEF'] = 'none';
        }

        // Zurück nach XML schreiben, damit es gespeichert wird
        $incomingFieldArray['pi_flexform'] = GeneralUtility::array2xml(
            $data,
            '',
            0,
            'T3FlexForms'
        );

        // Optionales Logging bei Bedarf:
        $this->logger()->info('FlexForm defaults applied', [
            'id' => $id,
            'ctype' => $cType,
            'isNew' => $isNew,
        ]);
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
