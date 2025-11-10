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

        $content = (string)($event->getPreviewContent() ?? '');
        $style = 'background:' . htmlspecialchars($color) . ';border:1px solid rgba(0,0,0,.08);padding:6px;border-radius:4px;';
        $event->setPreviewContent('<div style="' . $style . '">' . $content . '</div>');
    }
}
