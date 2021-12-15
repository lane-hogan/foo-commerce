<?php

require_once('../settings.php');

class DBHelper
{
    static $connection;

    private static function connect()
    {
        if (isset($connection)) return;

        self::$connection = new PDO(
            'mysql:host=' .
                Settings::$environments[Settings::$env]['db_host'] .
                ';dbname=' . Settings::$environments[Settings::$env]['db_name'] .
                ';charset=' . Settings::$environments[Settings::$env]['db_charset'],
            Settings::$environments[Settings::$env]['db_user'],
            Settings::$environments[Settings::$env]['db_password'],
            Settings::$DB_OPTIONS
        );
    }

    /**
     * Queries 
     */
    public static function query($query, $data = [])
    {
        self::connect();
        $query = self::$connection->prepare($query);
        $query->execute($data);
        return $query;
    }

    /**
     * Insert values into a database
     * 
     * @param string $query
     * @param array $data
     * @return array last inserted id
     */
    public static function insert($query, $data = [])
    {
        self::query($query, $data);
        return self::$connection->lastInsertId();
    }
}
