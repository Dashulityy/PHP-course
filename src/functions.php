<?php

/*
 * Функция должна принимать массив строк и выводить каждую строку в отдельном параграфе (тег <p>)
 * Если в функцию передан второй параметр true, то возвращать (через return) результат в виде одной объединенной строки.
 */

function task1(array $string, bool $flag){
    $res = implode("\n", array_map(function (string $str) {
        return "<p>$str</p>";
    }, $string));

    if($flag){
        return $res;
    }

    echo $res;
}

/*
 * Функция должна принимать переменное число аргументов.
 * Первым аргументом обязательно должна быть строка, обозначающая арифметическое действие, которое необходимо выполнить со всеми передаваемыми аргументами.
 * Остальные аргументы это целые и/или вещественные числа.

Пример вызова: calcEverything(‘+’, 1, 2, 3, 5.2);
Результат: 1 + 2 + 3 + 5.2 = 11.2
 */

function task2(string $operation, ...$args){
    foreach($args as $arg){
        if(!is_int($arg) && !is_float($arg)){
            return "Ошибка: есть аргументы не числа!";
        }
    }

    switch($operation){
        case '+':
            return array_sum($args);
        case '-':
            return array_shift($args) - array_sum($args);
        case '*':
            $res = 1;
            foreach ($args as $arg){
                $res *= $arg;
            }
            return $res;
        case '/':
            $res = array_shift($args);
            foreach ($args as $arg){
                if($arg == 0){
                    return "Ошибка: деление на ноль!";
                }
                $res /= $arg;
            }
            return $res;
        default:
            return "Ошибка: нет такого арифметического действия";
    }
}

/*
 * Функция должна принимать два параметра – целые числа.
 * Если в функцию передали 2 целых числа, то функция должна отобразить таблицу умножения размером со значения параметров, переданных в функцию. (Например если передано 8 и 8, то нарисовать от 1х1 до 8х8). Таблица должна быть выполнена с использованием тега <table>
 * В остальных случаях выдавать корректную ошибку.
 */

function task3($a, $b){
    if(!is_int($a) || $a < 0){
        trigger_error('Первый переданный аргумент не является целым числом или меньще 0!');
        return false;
    }
    if(!is_int($b) || $b < 0 ){
        trigger_error('Второй переданный аргумент не является целым числом или меньше 0!');
        return false;
    }

    $res = '<table>';
    for($i = 1; $i <= $a; $i++){
        $res .= '<tr>';
        for($j = 1; $j <= $b; $j++){
            $res .= '<td>';
            $res .= $i*$j;
            $res .= '</td>';
        }
        $res .= '</tr>';
    }
    $res .= '</table>';

    return $res;
}

function task6(string $fname){
    $fp = fopen($fname, 'r');
    if(!$fp){
        return false;
    }

    $str = '';
    while(!feof($fp)){
        $str .= fgets($fp, 1024);
    }

    echo $str;
}