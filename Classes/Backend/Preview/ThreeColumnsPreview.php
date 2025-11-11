<?php
declare(strict_types=1);

namespace AndreasLoewer\ContainerPackage\Backend\Preview;

use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;
use TYPO3\CMS\Core\Utility\GeneralUtility;

final class ThreeColumnsPreview implements PreviewRendererInterface
{
    public function renderPageModulePreviewContent(GridColumnItem $item): string
    {
        $record = $item->getRecord();
        $title = (string)($record['header'] ?? '');
        $uid = (int)($record['uid'] ?? 0);

        $cols = [
            'left' => $this->countChildren($record, 201),
            'middle' => $this->countChildren($record, 202),
            'right' => $this->countChildren($record, 203),
        ];

        $titleHtml = $title !== '' ? '<strong>' . htmlspecialchars($title) . '</strong>' : '<strong>Dreispalter</strong>';
        $meta = 'UID ' . $uid . ' · ' . $cols['left'] . '/' . $cols['middle'] . '/' . $cols['right'] . ' Elemente (L/M/R)';

        return sprintf(
            '<div class="typo3-preview"><div>%s</div><div style="opacity:.7">%s</div></div>',
            $titleHtml,
            htmlspecialchars($meta)
        );
    }

    private function countChildren(array $record, int $colPos): int
    {
        // Schnelle Zählung über DataProvider. Keine Query-Builder-Injektion nötig.
        $pageId = (int)($record['pid'] ?? 0);
        if ($pageId <= 0) {
            return 0;
        }
        $connection = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Database\ConnectionPool::class)
            ->getConnectionForTable('tt_content');

        $qb = $connection->createQueryBuilder();
        return (int)$qb
            ->count('uid')
            ->from('tt_content')
            ->where(
                $qb->expr()->eq('pid', $qb->createNamedParameter($pageId, \PDO::PARAM_INT)),
                $qb->expr()->eq('colPos', $qb->createNamedParameter($colPos, \PDO::PARAM_INT)),
                $qb->expr()->eq('tx_container_parent', $qb->createNamedParameter((int)$record['uid'], \PDO::PARAM_INT)),
                $qb->expr()->eq('deleted', 0)
            )
            ->executeQuery()
            ->fetchOne();
    }
}
