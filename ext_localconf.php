<?php
declare(strict_types=1);

defined('TYPO3') or die();

(static function (): void {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][]
        = \AndreasLoewer\ContainerPackage\DataHandler\FlexFormDefaultsHook::class;
})();
