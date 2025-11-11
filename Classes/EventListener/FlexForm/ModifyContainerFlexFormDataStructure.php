<?php
declare(strict_types=1);

namespace AndreasLoewer\ContainerPackage\EventListener\FlexForm;

use TYPO3\CMS\Core\Configuration\Event\AfterFlexFormDataStructureParsedEvent;

final class ModifyContainerFlexFormDataStructure
{
    public function __invoke(AfterFlexFormDataStructureParsedEvent $event): void
    {
        // Nur tt_content.pi_flexform anfassen
        if ($event->getTableName() !== 'tt_content' || $event->getFieldName() !== 'pi_flexform') {
            return;
        }

        $row = $event->getRecord() ?? [];
        $ctype = (string)($row['CType'] ?? '');

        // Nur unsere Container-CTypes behandeln
        switch ($ctype) {
            case 'container_one_column':
                $event->setDataStructure($this->buildDs(1));
                break;

            case 'container_two_columns':
                $event->setDataStructure($this->buildDs(2));
                break;

            case 'container_three_columns':
                $event->setDataStructure($this->buildDs(3));
                break;

            // Section-Container: eigenes FlexForm behalten → nichts tun
            default:
                return;
        }
    }

    /**
     * Baut eine FlexForm-Datenstruktur mit gemeinsamen Feldern plus
     * 1/2/3 Spalten-spezifischen Feldern.
     */
    private function buildDs(int $columns): array
    {
        $el = [
            // Gemeinsame Felder
            'spacingTop' => [
                'label' => 'Abstand oben',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['–', ''],
                        ['XS', 'mt-xs'],
                        ['S',  'mt-s'],
                        ['M',  'mt-m'],
                        ['L',  'mt-l'],
                    ],
                ],
            ],
            'spacingBottom' => [
                'label' => 'Abstand unten',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['–', ''],
                        ['XS', 'mb-xs'],
                        ['S',  'mb-s'],
                        ['M',  'mb-m'],
                        ['L',  'mb-l'],
                    ],
                ],
            ],
            'bgColor' => [
                'label' => 'Hintergrund',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['Transparent', ''],
                        ['Hell', 'bg-light'],
                        ['Dunkel', 'bg-dark'],
                    ],
                ],
            ],
        ];

        // Spalten-Felder je nach Anzahl
        if ($columns >= 1) {
            $el['columnClassLeft'] = [
                'label' => $columns === 1 ? 'Klasse Spalte' : 'Klasse linke Spalte',
                'config' => ['type' => 'input'],
            ];
        }
        if ($columns >= 2) {
            $el['columnClassRight'] = [
                'label' => 'Klasse rechte Spalte',
                'config' => ['type' => 'input'],
            ];
        }
        if ($columns >= 3) {
            $el['columnClassMiddle'] = [
                'label' => 'Klasse mittlere Spalte',
                'config' => ['type' => 'input'],
            ];
        }

        return [
            'sheets' => [
                'sDEF' => [
                    'ROOT' => [
                        'sheetTitle' => 'Container-Settings',
                        'type' => 'array',
                        'el' => $el,
                    ],
                ],
            ],
        ];
    }
}
