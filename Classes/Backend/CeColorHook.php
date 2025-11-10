<?php
namespace Vendor\Sitepackage\Backend;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;

class CeColorHook implements PageLayoutViewDrawItemHookInterface
{
    public function preProcess(
        PageLayoutView &$parent,
                       &$drawItem,
                       &$headerContent,
                       &$itemContent,
        array &$row
    ) {
        $ctype = (string)($row['CType'] ?? '');
        // nur unsere Container-CTypes
        if (!in_array($ctype, ['1col-container','2col-container','3col-container'], true)) {
            return;
        }
        $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
        if ($color === '') {
            return;
        }
        $style = 'background:' . htmlspecialchars($color) . ';border:1px solid rgba(0,0,0,.08);';
        $itemContent = '<div style="' . $style . '">' . $itemContent . '</div>';
    }
}
