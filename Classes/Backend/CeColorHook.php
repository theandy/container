<?php
namespace AndreasLoewer\ContainerPackage\Backend;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;

final class CeColorHook implements PageLayoutViewDrawItemHookInterface
{
    public function preProcess(
        PageLayoutView &$parentObject,
                       &$drawItem,
                       &$headerContent,
                       &$itemContent,
        array &$row
    ) {
        // nur tt_content Container-CTypes
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

        // Nur CSS injizieren. Nichts wrappen. Rendering NICHT übernehmen.
        $c = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $style = <<<HTML
<style data-container-bg="{$uid}">
.t3-page-ce[data-uid="{$uid}"],
.t3-page-ce[data-element-uid="{$uid}"],
.t3js-page-ce[data-uid="{$uid}"],
.t3js-page-ce[data-element-uid="{$uid}"],
.t3-page-ce-dragitem[data-uid="{$uid}"]{
  background: {$c} !important;
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 4px;
}
</style>
HTML;

        $itemContent = $style . $itemContent;

        // WICHTIG: $drawItem NICHT auf true setzen.
        // Dann rendert TYPO3/b13 den Rest (Header, Kinder, etc.) ganz normal.
    }
}
