<?php
/*
 * Создайте массив $bmw с ячейками:
    model
    speed
    doors
    year
 * Заполните ячейки значениями соответсвенно: “X5”, 120, 5, “2015”.
 * Создайте массивы $toyota' и '$opel аналогичные массиву $bmw (заполните данными).
 * Объедините три массива в один многомерный массив.
 * Выведите значения всех трех массивов
 */

$bmw = [
    'model' => 'X5',
    'speed' => 120,
    'doors' => 5,
    'year' => "2015"
];

$toyota = [
    'model' => 'rav4',
    'speed' => 120,
    'doors' => 5,
    'year' => 2020
];

$opel = [
    'model' => 'astra',
    'speed' => 120,
    'doors' => 5,
    'year' => 2014
];

$cars = ['bmw' => $bmw, 'toyota' => $toyota, 'opel' => $opel];

foreach ($cars as $name => $values ){
    echo "CAR $name \n";
    echo "$name  {$values["model"]} {$values["speed"]} {$values["doors"]} {$values["year"]} \n";
}