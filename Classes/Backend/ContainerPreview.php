<?php
namespace AndreasLoewer\ContainerPackage\Backend;

if (interface_exists(\TYPO3\CMS\Backend\View\Rendering\PreviewRendererInterface::class)) {
    use TYPO3\CMS\Backend\View\PageLayoutView;
    use TYPO3\CMS\Backend\View\Rendering\PreviewRendererInterface;

    final class ContainerPreview implements PreviewRendererInterface
    {
        public function render(PageLayoutView $parentObject, array $row): string
        {
            $ctype = (string)($row['CType'] ?? '');
            if ($ctype === '' || substr($ctype, -10) !== '-container') {
                return '';
            }
            $uid = (int)($row['uid'] ?? 0);
            if ($uid <= 0) {
                return '';
            }

            $color = trim((string)($row['tx_backend_bgcolor'] ?? ''));
            if ($color === '') {
                return '';
            }

            $c = htmlspecialchars($color, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            return <<<HTML
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
        }
    }
}
