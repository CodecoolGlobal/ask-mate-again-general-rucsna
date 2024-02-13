<?php

namespace app;

use PDO;

class Database
{
    public static function connect(): PDO
    {
        $configFile = dirname(__DIR__) . '/app/config/config.json';
        $configJson = file_get_contents($configFile);
        $config = json_decode($configJson, true);

        $databaseConfig = $config['database'];
        $dsn = "mysql:host={$databaseConfig['host']};dbname={$databaseConfig['database_name']};charset=utf8mb4";
        $pdo = new PDO($dsn, $databaseConfig['username'], $databaseConfig['password']);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    }
}