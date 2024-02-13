<?php
namespace App;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;
    private function __construct()
    {
        $config = json_decode(file_get_contents('config.json'), true);

        $dsn = 'mysql:host=' . $config['database']['host'] . ';dbname=' . $config['database']['database_name'];
        $username = $config['database']['username'];
        $password = $config['database']['password'];

        $connection = new PDO($dsn, $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
