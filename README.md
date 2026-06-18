# Container-Package — TYPO3-Extension

Eine TYPO3-Extension, die auf [`b13/container`](https://github.com/b13/container) aufbaut und fertige Container-Inhaltselemente für Spaltenlayouts und Seitenabschnitte bereitstellt.

## Inhaltselemente

| CType | Bezeichnung | Spalten |
|---|---|---|
| `container_one_column` | 1 Spalte | 1 (colPos 201) |
| `container_two_columns` | 2 Spalten | 2 (colPos 211, 212) |
| `container_three_columns` | 3 Spalten | 3 (colPos 221, 222, 223) |
| `container_section` | Section-Container | 1 (colPos 231) |

Alle Elemente erscheinen im Backend-Wizard unter der Gruppe **Containers** und bringen eigene SVG-Icons mit.

## FlexForm-Einstellungen

### Spalten-Container (1-, 2-, 3-spaltig)

| Feld | Beschreibung | Beispielwerte |
|---|---|---|
| Spacing Top | Abstand oben (CSS-Klasse) | – / mt-xs / mt-s / mt-m / mt-l |
| Spacing Bottom | Abstand unten (CSS-Klasse) | – / mb-xs / mb-s / mb-m / mb-l |
| Background | Hintergrundfarbe | Transparent / bg-light / bg-dark |
| Classes container | CSS-Klassen für das äußere `<div>` | `container` (Standard) |
| Classes row | CSS-Klassen für die Zeile | `row` (Standard) |
| Classes col 1/2/3 | CSS-Klassen je Spalte | `col-md-6` (Standard bei 2-spaltig) |

### Section-Container

| Feld | Beschreibung |
|---|---|
| HTML-Tag | `section` (Standard) oder `div` |
| ID | HTML-`id`-Attribut |
| Aria-Label | `aria-label`-Attribut |
| Zusätzliche Klassen | Eigene CSS-Klassen |
| Spacing Top / Bottom | Abstände (wie oben) |

## HTML-Ausgabe

**Spalten-Container:**
```html
<div class="c-container container mt-m bg-light" id="c{uid}">
    <div class="row">
        <div class="c-col c-col--left col-md-6">…</div>
        <div class="c-col c-col--right col-md-6">…</div>
    </div>
</div>
```

**Section-Container:**
```html
<section id="my-section" class="c-section mt-m" aria-label="Über uns">
    …
</section>
```

## Voraussetzungen

- TYPO3 `^12.4` oder `^13.4`
- PHP `^8.1`
- `b13/container` `^3.1.10`

## Installation

```bash
composer require andreas-loewer/container-package
```

Anschließend im TYPO3-Backend das statische TypoScript-Template einbinden:

> **Web → Template → Static includes:** `Container-Package (container_package)`

## TypoScript anpassen

Die Template-Pfade können im eigenen Sitepackage überschrieben werden:

```typoscript
container_package.view {
    templateRootPaths.20 = EXT:my_sitepackage/Resources/Private/Templates/Content/
    partialRootPaths.20  = EXT:my_sitepackage/Resources/Private/Partials/
    layoutRootPaths.20   = EXT:my_sitepackage/Resources/Private/Layouts/
}
```

Die CSS-Datei lässt sich ebenfalls tauschen:

```typoscript
container_package.assets.cssFile = EXT:my_sitepackage/Resources/Public/Css/containers.css
```

## Sprachen

Englisch und Deutsch werden mitgeliefert (`locallang_db.xlf` + `de.locallang_db.xlf`).

## Lizenz

GPL-2.0-or-later — Andreas Löwer &lt;info@andreasloewer.de&gt;
