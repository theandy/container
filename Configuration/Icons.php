<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'content-container-block' => [
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        'source' => 'EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg',
    ],
    'content-container-1col' => [
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        'source' => 'EXT:container_package/Resources/Public/Icons/content-container-1col.svg',
    ],
    'content-container-2col' => [
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        'source' => 'EXT:container_package/Resources/Public/Icons/content-container-2col.svg',
    ],
    'content-container-3col' => [ // schon vorhanden
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        'source' => 'EXT:container_package/Resources/Public/Icons/content-container-3col.svg',
    ],
    'content-container-section' => [
        'provider' => \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        'source' => 'EXT:container_package/Resources/Public/Icons/content-container-section.svg',
    ],
];