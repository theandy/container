<?php

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)-> configureContainer(
    (
        new \B13\Container\Tca\ContainerConfiguration(
            'section-container', 
            'Section',
            'Insert a section element to group content.',
            [
                [
                    ['name' => 'Column', 'colPos' => 201]
                ]
            ]
        )
    )
    ->setIcon('EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg')
);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)-> configureContainer(
    (
        new \B13\Container\Tca\ContainerConfiguration(
            '1col-container', 
            '1 Column Container',
            'Insert a container element to group content.',
            [
                [
                    ['name' => 'Column', 'colPos' => 201]
                ]
            ]
        )
    )
    ->setIcon('EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg')
    ->setDefaultValues(['tx_container_classes_col_1' => 'col-12'])
);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)-> configureContainer(
    (
        new \B13\Container\Tca\ContainerConfiguration(
            '2col-container', 
            '2 Column Container',
            'Insert a container element to divide content into tow columns.',
            [
                [
                    ['name' => 'Left Column', 'colPos' => 201],
                    ['name' => 'Right Column', 'colPos' => 202]
                ]
            ]
        )
    )
    ->setIcon('EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg')
    ->setDefaultValues(['tx_container_classes_col_1' => 'col-lg-6', 'tx_container_classes_col_2' => 'col-lg-6'])
);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)-> configureContainer(
    (
        new \B13\Container\Tca\ContainerConfiguration(
            '3col-container', 
            '3 Column Container',
            'Insert a container element to divide content into three columns.',
            [
                [
                    ['name' => 'Left Column', 'colPos' => 201],
                    ['name' => 'Middle Column', 'colPos' => 202],
                    ['name' => 'Right Column', 'colPos' => 203]
                ]
            ]
        )
    )
    ->setIcon('EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg')
    ->setDefaultValues(['tx_container_classes_col_1' => 'col-lg-4', 'tx_container_classes_col_2' => 'col-lg-4', 'tx_container_classes_col_3' => 'col-lg-4'])
);

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)-> configureContainer(
    (
        new \B13\Container\Tca\ContainerConfiguration(
            '4col-container', 
            '4 Column Container',
            'Insert a container element to divide content into three columns.',
            [
                [
                    ['name' => 'Column 1', 'colPos' => 201],
                    ['name' => 'Column 2', 'colPos' => 202],
                    ['name' => 'Column 3', 'colPos' => 203],
                    ['name' => 'Column 4', 'colPos' => 204]
                ]
            ]
        )
    )
    ->setIcon('EXT:container_package/Resources/Public/Icons/column-svgrepo-com.svg')
    ->setDefaultValues(['tx_container_classes_col_1' => 'col-6 col-lg-3', 'tx_container_classes_col_2' => 'col-6 col-lg-3', 'tx_container_classes_col_3' => 'col-6 col-lg-3', 'tx_container_classes_col_4' => 'col-6 col-lg-3'])
);

$temporaryColumn = [
    'tx_container_bg_section' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:deine_extension/Resources/Private/Language/locallang_db.xlf:deine_tabelle.tx_container_background_image',
        'config' => [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'showAllLocalizationLink' => true
            ],
        ],
    ],
    'tx_container_bg_col_1' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:deine_extension/Resources/Private/Language/locallang_db.xlf:deine_tabelle.tx_container_background_image',
        'config' => [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'showAllLocalizationLink' => true
            ],
        ],
    ],
    'tx_container_bg_col_2' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:deine_extension/Resources/Private/Language/locallang_db.xlf:deine_tabelle.tx_container_background_image',
        'config' => [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'showAllLocalizationLink' => true
            ],
        ],
    ],
    'tx_container_bg_col_3' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:deine_extension/Resources/Private/Language/locallang_db.xlf:deine_tabelle.tx_container_background_image',
        'config' => [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'showAllLocalizationLink' => true
            ],
        ],
    ],
    'tx_container_bg_col_4' => [
        'exclude' => 0,
        'label' => 'LLL:EXT:deine_extension/Resources/Private/Language/locallang_db.xlf:deine_tabelle.tx_container_background_image',
        'config' => [
            'type' => 'file',
            'allowed' => 'common-image-types',
            'minitems' => 0,
            'maxitems' => 1,
            'appearance' => [
                'showAllLocalizationLink' => true
            ],
        ],
    ],
    'tx_container_classes_section' => [
        'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:section-container',
                ]
            ],
        ],
      'label' => 'Classes for section',
      'config' => [
         'type' => 'input',
         'default' => ''
      ],
   ],
    'tx_container_classes_container' => [
        'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:1col-container',
                    'FIELD:CType:=:2col-container',
                    'FIELD:CType:=:3col-container',
                    'FIELD:CType:=:4col-container',
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes container',
      'config' => [
         'type' => 'input',
         'default' => 'container container-default'
      ],
   ],
    'tx_container_classes_row' => [
        'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:1col-container',
                    'FIELD:CType:=:2col-container',
                    'FIELD:CType:=:3col-container',
                    'FIELD:CType:=:4col-container',
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes row',
      'config' => [
         'type' => 'input',
         'default' => 'row'
      ],
   ],
    'tx_container_classes_col_1' => [
        'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:1col-container',
                    'FIELD:CType:=:2col-container',
                    'FIELD:CType:=:3col-container',
                    'FIELD:CType:=:4col-container',
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes column 1',
      'config' => [
         'type' => 'input',
         'default' => 'col-'
      ],
   ],
   'tx_container_classes_col_2' => [
      'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:2col-container',
                    'FIELD:CType:=:3col-container',
                    'FIELD:CType:=:4col-container',
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes column 2',
      'config' => [
         'type' => 'input',
         'default' => 'col-'
      ],
   ],
   'tx_container_classes_col_3' => [
      'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:3col-container',
                    'FIELD:CType:=:4col-container',
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes column 3',
      'config' => [
         'type' => 'input',
         'default' => 'col-'
      ],
   ],
   'tx_container_classes_col_4' => [
      'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:4col-container',
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes column 4',
      'config' => [
         'type' => 'input',
         'default' => 'col-'
      ],
   ],
   'tx_container_classes_col_5' => [
      'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:5col-container',
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes column 5',
      'config' => [
         'type' => 'input',
         'default' => 'col-'
      ],
   ],
   'tx_container_classes_col_6' => [
      'exclude' => 0,
        'displayCond' => [
            'AND' => [
                'OR' => [
                    'FIELD:CType:=:6col-container',
                ]
            ],
        ],
      'label' => 'Classes column 6',
      'config' => [
         'type' => 'input',
         'default' => 'col-'
      ],
   ],
    
    
    

    
];









// Add new fields to table:
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $temporaryColumn);


$GLOBALS['TCA']['tt_content']['types']['section-container']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,               
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:tab.label,
        tx_container_classes_section;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.section.label,
        tx_container_bg_section;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:bg_img_section.label,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['1col-container']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,               
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:tab.label,
        tx_container_classes_container;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.container.label,
        tx_container_classes_row;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.row.label,
        tx_container_classes_col_1;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col1.label,
        tx_container_bg_col_1;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:bg_img_col_1.label,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['2col-container']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,               
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:tab.label,
        tx_container_classes_container;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.container.label,
        tx_container_classes_row;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.row.label,
        tx_container_classes_col_1;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col1.label,
        tx_container_bg_col_1;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:bg_img_col_1.label,
        tx_container_classes_col_2;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col2.label,
        tx_container_bg_col_2;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:bg_img_col_2.label, 
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['3col-container']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,               
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:tab.label,
        tx_container_classes_container;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.container.label,
        tx_container_classes_row;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.row.label,
        tx_container_classes_col_1;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col1.label, 
        tx_container_classes_col_2;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col2.label, 
        tx_container_classes_col_3;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col3.label,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';

$GLOBALS['TCA']['tt_content']['types']['4col-container']['showitem'] = '
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
        --palette--;;general,
        --palette--;;headers,               
        bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
        --palette--;;frames,
        --palette--;;appearanceLinks,
    --div--;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:tab.label,
        tx_container_classes_container;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.container.label,
        tx_container_classes_row;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.row.label,
        tx_container_classes_col_1;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col1.label, 
        tx_container_classes_col_2;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col2.label, 
        tx_container_classes_col_3;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col3.label,
        tx_container_classes_col_4;LLL:EXT:container_package/Resources/Private/Language/locallang_tabs.xlf:classes.col4.label,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
        --palette--;;language,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
        --palette--;;hidden,
        --palette--;;access,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
        categories,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
        rowDescription,
    --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
';