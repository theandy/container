<?php
namespace AndreasLoewer\ContainerPackage\Backend\Xclass;

use B13\Container\Backend\Preview\ContainerPreviewRenderer as B13Preview;
use TYPO3\CMS\Backend\View\PageLayoutView;

final class ContainerPreviewRenderer extends B13Preview
{
    public function render(PageLayoutView $parentObject, array $row): string
    {
        // hole bestehende Preview (wichtig: Kinder sollen bleiben)
        $out = parent::render($parentObject, $row);

        // nur *-container einfärben und nur wenn Farbe gesetzt ist
        $ctype = (string)($row['CType'] ?? '');
        if ($ctype === '' || substr($ctype, -10) !== '-container') {
            return $out;
        }
        $uid   = (int)($row['uid'] ?? 0);
        $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
        if ($uid <= 0 || $color === '') {
            return $out;
        }

        $c = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $style = <<<HTML
<style data-container-bg="{$uid}">
.t3-page-ce[data-uid="{$uid}"],
.t3-page-ce[data-element-uid="{$uid}"],
.t3js-page-ce[data-uid="{$uid}"],
.t3js-page-ce[data-element-uid="{$uid}"],
.t3-page-ce-dragitem[data-uid="{$uid}"]{
  background: {$c} !important;
  border: 1px solid rgba(0,0,0,.12);
  border-radius: 4px;
  box-shadow: 0 0 0 1px rgba(0,0,0,.03) inset;
}
</style>
HTML;

        // nur CSS anhängen, nichts wrappen
        return $style . $out;
    }
}
