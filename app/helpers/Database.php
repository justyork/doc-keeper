<?php
class Database {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            $config = include __DIR__ . '/../../config/database.php';
            self::$connection = new mysqli(
                $config['host'],
                $config['user'],
                $config['password'],
                $config['database']
            );

            if (self::$connection->connect_error) {
                die("Database connection failed: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}