<?php

// Classes/Backend/CeColorHook.php
use TYPO3\CMS\Backend\View\PageLayoutView;
use TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;

class CeColorHook implements PageLayoutViewDrawItemHookInterface {
    public function preProcess(PageLayoutView &$parent, &$drawItem, &$headerContent, &$itemContent, array &$row) {
        $ctype = (string)($row['CType'] ?? '');
        if ($ctype && str_starts_with($ctype, 'container_')) {
            $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
            if ($color !== '') {
                $itemContent = '<div style="background:' . htmlspecialchars($color) . ';border:1px solid rgba(0,0,0,.08)">' . $itemContent . '</div>';
            }
        }
    }
}
