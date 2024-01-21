<?php
/*
 * Программно создайте массив из 50 пользователей, у каждого пользователя есть поля `id`, `name` и `age`:
- `id`- уникальный идентификатор, равен номеру эл-та в массиве
- `name`- случайное имя из 5-ти возможных (сами придумайте каких)
- `age`- случайное число от 18 до 45
 */

const USERNAME = ['Alex', 'Tom', 'Kate', 'Sofi', 'Max'];

function createUser($ndx){
    return [
        'id' => $ndx,
        'name' => USERNAME[array_rand(USERNAME)],
        'age' => rand(18, 45)
    ];
}