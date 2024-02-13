<?php
namespace App;

use PDO;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;
    private function __construct()
    {
        $configPath = __DIR__ . '/config/config.json';
        $config = json_decode(file_get_contents($configPath), true);

        $dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['database_name'];
        $username = $config['database']['username'];
        $password = $config['database']['password'];

        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $this->connection = $connection;
    }

    public static function getInstance(): ?Database
    {
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
