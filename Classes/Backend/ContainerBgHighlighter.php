<?php
namespace AndreasLoewer\ContainerPackage\Backend;

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;

final class ContainerBgHighlighter
{
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        $row   = $event->getRecord();
        $ctype = (string)($row['CType'] ?? '');
        if ($ctype === '' || substr($ctype, -10) !== '-container') {
            return;
        }

        $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
        if ($color === '') {
            return; // keine Farbe -> nichts tun
        }

        $uid     = (int)($row['uid'] ?? 0);
        $content = (string)($event->getPreviewContent() ?? '');

        // Färbt die gesamte Kachel: .t3-page-ce[data-uid="<uid>"]
        $css = sprintf(
            '<style data-container-bg="%d">.t3-page-ce[data-uid="%d"]{background:%s !important;border:1px solid rgba(0,0,0,.08);border-radius:4px}</style>',
            $uid,
            $uid,
            htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8')
        );

        // Original-Content unverändert lassen, nur Style injizieren
        $event->setPreviewContent($css . $content);
    }
}
