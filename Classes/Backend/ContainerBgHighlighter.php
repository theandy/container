<?php
namespace AndreasLoewer\ContainerPackage\Backend;

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;

final class ContainerBgHighlighter
{
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        $row = $event->getRecord();
        $ctype = (string)($row['CType'] ?? '');
        if ($ctype === '' || substr($ctype, -10) !== '-container') {
            return;
        }

        $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
        if ($color === '') {
            return;
        }

        $uid = (int)($row['uid'] ?? 0);
        $content = (string)($event->getPreviewContent() ?? '');

        // CSS nur injizieren, nichts wrappen. Mehrere mögliche Wrapper selektieren.
        $colorEsc = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $css = <<<HTML
<style data-container-bg="{$uid}">
/* TYPO3 12: Kachel-Wrapper variieren je nach Ansicht/Drag */
.t3-page-ce[data-uid="{$uid}"],
.t3-page-ce .t3-page-ce-wrapper[data-uid="{$uid}"],
.t3-page-ce-dragitem[data-uid="{$uid}"]{
  background: {$colorEsc} !important;
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 4px;
}
</style>
HTML;

        $event->setPreviewContent($css . $content);
    }
}
