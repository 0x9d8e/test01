<?php

namespace Core;
use PDO;

/**
 * Class Db
 * Вообще его надо было просто унаследовать от PDO,
 * а синглтон сделать трейтом, но я решил остановиться.
 * @package Core
 */
class Db extends Singleton
{
    private $pdo;

    protected function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=testdb;host=127.0.0.1', 'root', 'qwerty');
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }

    public function __get($name)
    {
        return $this->pdo->$name;
    }

    public function __set($name, $value)
    {
        return $this->pdo->$name = $value;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}