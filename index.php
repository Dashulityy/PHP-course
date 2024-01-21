<?php
/*
 * Программно создайте массив из 50 пользователей, у каждого пользователя есть поля `id`, `name` и `age`:
 * `id`- уникальный идентификатор, равен номеру эл-та в массиве
 * `name`- случайное имя из 5-ти возможных (сами придумайте каких)
 * `age`- случайное число от 18 до 45
 * Преобразуйте массив в json и сохраните в файл `users.json`
 * Откройте файл `users.json` и преобразуйте данные из него обратно ассоциативный массив РНР.
 * Посчитайте количество пользователей с каждым именем в массиве
 * Посчитайте средний возраст пользователей
 */
include './src/functions.php';

for($i = 0; $i < 50; $i++){
    $users[] = createUser($i);
}

file_put_contents('users.json', json_encode($users));

$data = file_get_contents('users.json');
$decodedData = json_decode($data, true);

$userNames = [];
$userAges = 0;

foreach ($decodedData as $user){
    if(isset($userNames[$user['name']])){
        $userNames[$user['name']]++;
    }else{
        $userNames[$user['name']] = 1;
    }

    $userAges += $user['age'];
}

$averageAge = round($userAges/sizeof($decodedData));

foreach ($userNames as $name => $count){
    echo "Количество пользователей с именем $name равно $count \n";
}
echo "Средний возраст пользователей:  $averageAge";

