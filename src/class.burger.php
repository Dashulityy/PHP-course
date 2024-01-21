<?php
class Burger{

    public function getUserByEmail(string $email){
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        return $db->fetchOne($query, __METHOD__ , [':email' => $email]);
    }

    public function createUser(string $email){
        $db = Db::getInstance();
        $query = "INSERT INTO users(email) VALUES (:email)";
        $result = $db->exec($query, __METHOD__, [':email' => $email]);
        if(!$result){ // проверяем получилось ли создать пользователя
            return false;
        }

        return $db->lastInsertId(); // возвращаем идентификатор созданного пользователя
    }

    public function addOrder(int $userId, array $data){
        $db = Db::getInstance();
        $query = "INSERT INTO orders(user_id, address, orderDate) VALUES (:user_id, :address, :orderDate)";
        $result = $db->exec($query, __METHOD__,
            [
                ':user_id' => $userId,
                ':address' => $data['address'],
                ':orderDate' => date('Y-m-d H:i:s'),
            ]);
        if(!$result){ // проверяем получилось ли создать заказ
            return false;
        }
        return $db->lastInsertId();
    }

    public function incOrders(int $userId){
        $db = Db::getInstance();
        $query = "UPDATE users SET orderCount = orderCount + 1 WHERE id = $userId";
        return $db->exec($query, __METHOD__);
    }
}