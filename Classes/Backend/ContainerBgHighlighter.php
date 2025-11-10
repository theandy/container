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
            return; // nichts zu tun
        }

        $uid = (int)($row['uid'] ?? 0);
        $c   = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $u   = $uid;

        // Nur Style injizieren. Preview nicht wrappen, nichts entfernen.
        $css = <<<HTML
<style data-container-bg="$u">
.t3-page-ce[data-uid="$u"],
.t3-page-ce[data-element-uid="$u"],
.t3js-page-ce[data-uid="$u"],
.t3js-page-ce[data-element-uid="$u"],
.t3-page-ce-dragitem[data-uid="$u"],
#element-tt_content-$u,
#element-tt_content_$u,
.ce-element[data-uid="$u"]{
  background: $c !important;
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 4px;
}
</style>
HTML;

        $event->setPreviewContent($css . (string)$event->getPreviewContent());
    }
}
