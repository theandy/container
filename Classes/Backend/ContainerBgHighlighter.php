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

        // robust: diverse Wrapper/Attribute abdecken
        $c = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $u = $uid;
        $css = <<<HTML
<style data-container-bg="$u">
/* Hauptkachel */
.t3-page-ce[data-uid="$u"],
.t3-page-ce[data-element-uid="$u"],
.t3js-page-ce[data-uid="$u"],
.t3js-page-ce[data-element-uid="$u"],
.t3-page-ce-dragitem[data-uid="$u"]{
  background: $c !important;
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 4px;
}
/* Falls Header separat gerendert wird: leichte Tönung */
.t3-page-ce[data-uid="$u"] .t3-page-ce-header,
.t3-page-ce[data-element-uid="$u"] .t3-page-ce-header{
  background: color-mix(in srgb, $c 10%, transparent) !important;
}
</style>
HTML;

        // Nichts wrappen, nur CSS injizieren
        $event->setPreviewContent($css . $content);
    }
}
