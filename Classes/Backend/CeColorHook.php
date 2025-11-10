<?php
namespace AndreasLoewer\ContainerPackage\Backend;

use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;

final class CeColorHook implements PageLayoutViewDrawItemHookInterface
{
    public function preProcess(PageLayoutView &$parent, &$drawItem, &$headerContent, &$itemContent, array &$row)
    {
        $ctype = (string)($row['CType'] ?? '');
        if ($ctype === '' || substr($ctype, -10) !== '-container') {
            return;
        }
        $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
        if ($color === '') {
            return;
        }
        $style = 'background:' . htmlspecialchars($color) . ';border:1px solid rgba(0,0,0,.08);padding:6px;border-radius:4px;';
        $itemContent = '<div style="' . $style . '">' . $headerContent . $itemContent . '</div>';
        $headerContent = '';
    }
}
