<?php

namespace Models;

class Db {
    static $pdo = false;

    static function connect($host,$dbname,$user,$pass) {
        self::$pdo = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    }

    static function execute($query,$params = []) {
        if (!self::$pdo) die('PDO not connected');

        $statement = self::$pdo->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    static function select($query,$params = [])  {
        $statement = self::execute($query,$params);
        return $statement->fetchAll();
    }
}