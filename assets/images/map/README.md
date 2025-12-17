# Map images directory

This directory contains images for the interactive Russia map:

## Files

1. **`branches_map_transparent.gif`** - Transparent overlay image (528x313px)
   - This is the clickable/hoverable layer that sits on top of the map
   - Source: https://gociss.ru/img/branches_map_transparent.gif

2. **`branches_map_sprite.gif`** - Map sprite image (528x4382px)
   - Contains all map states stacked vertically (14 states × 313px each)
   - Each state shows a different region highlighted
   - This is used as a background-image for hover effects

## Sprite positions

- Default: `0px 0px`
- Южный ФО: `0px -313px`
- Центральный ФО: `0px -626px`
- Северо-Западный ФО: `0px -939px`
- Приволжский ФО: `0px -1252px`
- Уральский ФО: `0px -1565px`
- Сибирский ФО: `0px -1878px`
- Дальневосточный ФО: `0px -2191px`
- Прикубанский регион: `0px -2504px`
- Юго-Западный регион: `0px -2817px`
- Юго-Восточный регион: `0px -3130px`
- Волго-Камский регион: `0px -3443px`
- Центрально-Сибирский регион: `0px -3756px`
- Восточно-Сибирский регион: `0px -4069px`
