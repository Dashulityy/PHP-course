<?php
namespace App\Model;

use Base\Db;

class User
{
    private $id;
    private $name;
    private $createdAt;
    private $password;
    private $email;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->password = $data['password'];
        $this->createdAt = $data['createdAt'];
        $this->email = $data['email'];
    }

    public static function getByEmail(string $email)
    {
        $db = Db::getInstance();
        $query = "SELECT * FROM users WHERE email = :email";
        return $db->fetchOne($query, __METHOD__ , [':email' => $email]);
        if (!$query) {
            return null;
        }

        $user = new self($query);
        $user->id = $query['id'];
        return $user;
    }

    public static function getByIds(array $userIds)
    {
        $db = Db::getInstance();
        $idsString = implode(',', $userIds);
        $data = $db->fetchAll(
            "SELECT * fROM users WHERE id IN($idsString)",
            __METHOD__
        );
        if (!$data) {
            return [];
        }

        $users = [];
        foreach ($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[$user->id] = $user;
        }

        return $users;
    }

    public function save()
    {
        $db = Db::getInstance();
        $res = $db->exec(
            'INSERT INTO users (
                    name, 
                    password, 
                    createdAt,
                    email
                    ) VALUES (
                    :name, 
                    :password, 
                    :createdAt,
                    :email
                )',
            __FILE__,
            [
                ':name' => $this->name,
                ':password' => self::getPasswordHash($this->password),
                ':createdAt' => $this->createdAt,
                ':email' => $this->email,
            ]
        );

        $this->id = $db->lastInsertId();

        return $res;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $data = $db->fetchOne("SELECT * fROM users WHERE id = :id", __METHOD__, [':id' => $id]);
        if (!$data) {
            return null;
        }

        $user = new self($data);
        $user->id = $id;
        return $user;
    }


    public static function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Db::getInstance();
        $data = $db->fetchAll(
            "SELECT * fROM users LIMIT $limit OFFSET $offset",
            __METHOD__
        );
        if (!$data) {
            return [];
        }

        $users = [];
        foreach ($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[] = $user;
        }

        return $users;
    }

    public static function getPasswordHash(string $password)
    {
        return sha1('j/fyu.,kiwr' . $password);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    public function isAdmin(): bool
    {
        return in_array($this->id, ADMIN_IDS);
    }
}