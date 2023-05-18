<?php

require 'config\DB.php';

use config\DB;

$start = microtime(true);
try {
    createTable();
    fillTable();
    updateTable();
} catch (Exception $e) {
    echo $e->getMessage();
}
echo 'Executed for: ' . round(microtime(true) - $start, 3) . ' sec.';

/**
 * Создание таблицы продуктов
 * @throws Exception
 */
function createTable(): void
{
    $sql = 'CREATE TABLE `products` (
      `id` int(11) NOT NULL,
      `name` tinytext,
      `price` float(9,2) DEFAULT 0.00,
      `color` tinytext,
      UNIQUE KEY `id` (`id`)
    ) ENGINE=innoDB;
    ';

    DB::getInstance()->query($sql);
}

/**
 * Fill the table with 1+ billion rows
 * @throws Exception
 */
function fillTable(): void
{
    $sql = '
        SET autocommit=0; 
        SET unique_checks=0;
        SET foreign_key_checks=0;
        INSERT INTO `products` (name, price, color) VALUES ' . generateTableData(1000001) . ';
        SET unique_checks=1;
        SET foreign_key_checks=1;
        COMMIT;
    ';

    DB::getInstance()->query($sql);
}

/**
 * Update the table with rules:
 * color=red decrease the price by 5%,
 * color=green increase the price by 10%
 * @throws Exception
 */
function updateTable(): void
{
    $sql = '
    UPDATE products 
    SET `price` = 
        CASE 
            WHEN color = "Red" THEN price*0.95 
            WHEN color = "Green" THEN price*1.10 
        END
    WHERE color IN ("Red", "Green");
    ';

    DB::getInstance()->query($sql);
}

/**
 * Generate values for insert
 * @param int $count [optional]
 * @return string
 */
function generateTableData(int $count = 2): string
{
    $res = [];

    for ($i = 1; $i <= $count; $i++) {
        $res[] = '("Item",' . (float)rand(1, 1000000) / 100 . ',"' . getColor() . '")';
    }

    return implode(',', $res);
}

/**
 * Get random color from set
 * @return string
 */
function getColor(): string
{
    $arrColors = [
        'AliceBlue',
        'AntiqueWhite',
        'Aqua',
        'Aquamarine',
        'Azure',
        'Beige',
        'Bisque',
        'Black',
        'BlanchedAlmond',
        'Blue',
        'BlueViolet',
        'Brown',
        'BurlyWood',
        'CadetBlue',
        'Chartreuse',
        'Chocolate',
        'Coral',
        'CornflowerBlue',
        'Cornsilk',
        'Crimson',
        'Cyan',
        'DarkBlue',
        'DarkCyan',
        'DarkGoldenRod',
        'DarkGray',
        'DarkGrey',
        'DarkGreen',
        'DarkKhaki',
        'DarkMagenta',
        'DarkOliveGreen',
        'Darkorange',
        'DarkOrchid',
        'DarkRed',
        'DarkSalmon',
        'DarkSeaGreen',
        'DarkSlateBlue',
        'DarkSlateGray',
        'DarkSlateGrey',
        'DarkTurquoise',
        'DarkViolet',
        'DeepPink',
        'DeepSkyBlue',
        'DimGray',
        'DimGrey',
        'DodgerBlue',
        'FireBrick',
        'FloralWhite',
        'ForestGreen',
        'Fuchsia',
        'Gainsboro',
        'GhostWhite',
        'Gold',
        'GoldenRod',
        'Gray',
        'Grey',
        'Green',
        'GreenYellow',
        'HoneyDew',
        'HotPink',
        'IndianRed',
        'Indigo',
        'Ivory',
        'Khaki',
        'Lavender',
        'LavenderBlush',
        'LawnGreen',
        'LemonChiffon',
        'LightBlue',
        'LightCoral',
        'LightCyan',
        'LightGoldenRodYellow',
        'LightGray',
        'LightGrey',
        'LightGreen',
        'LightPink',
        'LightSalmon',
        'LightSeaGreen',
        'LightSkyBlue',
        'LightSlateGray',
        'LightSlateGrey',
        'LightSteelBlue',
        'LightYellow',
        'Lime',
        'LimeGreen',
        'Linen',
        'Magenta',
        'Maroon',
        'MediumAquaMarine',
        'MediumBlue',
        'MediumOrchid',
        'MediumPurple',
        'MediumSeaGreen',
        'MediumSlateBlue',
        'MediumSpringGreen',
        'MediumTurquoise',
        'MediumVioletRed',
        'MidnightBlue',
        'MintCream',
        'MistyRose',
        'Moccasin',
        'NavajoWhite',
        'Navy',
        'OldLace',
        'Olive',
        'OliveDrab',
        'Orange',
        'OrangeRed',
        'Orchid',
        'PaleGoldenRod',
        'PaleGreen',
        'PaleTurquoise',
        'PaleVioletRed',
        'PapayaWhip',
        'PeachPuff',
        'Peru',
        'Pink',
        'Plum',
        'PowderBlue',
        'Purple',
        'Red',
        'RosyBrown',
        'RoyalBlue',
        'SaddleBrown',
        'Salmon',
        'SandyBrown',
        'SeaGreen',
        'SeaShell',
        'Sienna',
        'Silver',
        'SkyBlue',
        'SlateBlue',
        'SlateGray',
        'SlateGrey',
        'Snow',
        'SpringGreen',
        'SteelBlue',
        'Tan',
        'Teal',
        'Thistle',
        'Tomato',
        'Turquoise',
        'Violet',
        'Wheat',
        'White',
        'WhiteSmoke',
        'Yellow',
        'YellowGreen'
    ];

    return array_rand(array_flip($arrColors));
}
