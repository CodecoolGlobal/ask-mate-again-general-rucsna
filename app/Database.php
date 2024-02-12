<?php

namespace App;

use PDO;

class Database
{
    public static function connect($config)
    {
        $dsn = "mysql:host={$config['host']};dbname={$config['database_name']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }
}