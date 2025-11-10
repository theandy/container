<?php
namespace AndreasLoewer\ContainerPackage\Backend;

use TYPO3\CMS\Backend\View\Event\PageContentPreviewRenderingEvent;

final class ContainerBgHighlighter
{
    public function __invoke(PageContentPreviewRenderingEvent $event): void
    {
        // nur tt_content
        if ($event->getTable() !== 'tt_content') {
            return;
        }

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
        if ($uid <= 0) {
            return;
        }

        $c = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        // Nur Style injizieren. Nichts wrappen. Preview-Content nicht ersetzen.
        $css = <<<HTML
<style data-container-bg="$uid">
/* häufige Wrapper im Seitenmodul */
.t3-page-ce[data-uid="$uid"],
.t3-page-ce[data-element-uid="$uid"],
.t3js-page-ce[data-uid="$uid"],
.t3js-page-ce[data-element-uid="$uid"],
.t3-page-ce-dragitem[data-uid="$uid"],
#element-tt_content-$uid,
#element-tt_content_$uid,
.ce-element[data-uid="$uid"]{
  background: $c !important;
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 4px;
}
</style>
HTML;

        // Nur CSS setzen. Keine Inhalte anhängen.
        $event->setPreviewContent($css);
    }
}
