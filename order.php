<?php
include './src/config.php';
include './src/class.db.php';
include './src/class.burger.php';

/*
 * Проверить, существует ли уже пользователь с таким email, если нет - создать его, если да - увеличить число заказов по этому email. Двух пользователей с одинаковым email быть не может.
 * Сохранить данные заказа - id пользователя, сделавшего заказ, дату заказа, полный адрес клиента.
 * Скрипт должен вывести пользователю:

Спасибо, ваш заказ будет доставлен по адресу: “тут адрес клиента”
Номер вашего заказа: #ID
Это ваш n-й заказ!

Где ID- уникальный идентификатор только что созданного заказа n - общий кол-во заказов, который сделал пользователь с этим email включая текущий
 */

$burger = new Burger();

$email = $_POST['email'];
$address = "{$_POST['street']} {$_POST['home']} {$_POST['part']} {$_POST['appt']} {$_POST['floor']} ";
$data = ['address' => $address];
$user = $burger->getUserByEmail($email);
if($user){
    $userId = $user['id'];
    $burger->incOrders($user['id']);
    $orderCount = $user['orderCount'] + 1;
}else{
    $orderCount = 1;
    $userId = $burger->createUser($email);
}

$orderId = $burger->addOrder($userId, $data);

//echo "<p>Спасибо, ваш заказ будет доставлен по адресу: $address<br>
//Номер вашего заказа: #$orderId <br>
//Это ваш $orderCount-й заказ!</p>";
//echo '<img src="img/content/kitty.jpg" />';

echo "<div style='display: flex; flex-direction: column; align-items: center;'>";
echo "<p>Спасибо, ваш заказ будет доставлен по адресу: $address<br>
        Номер вашего заказа: #$orderId <br>
        Это ваш $orderCount-й заказ!
    </p>";
echo "<img src='img/content/kitty.jpg' width='200' height='auto' style='align-content: center'/>";
echo "</div>";
