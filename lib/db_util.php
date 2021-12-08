<?php
require_once('../settings.php');

class DBHelper
{
    static $connection;

    public static function connect()
    {
        self::$connection = new PDO(
            'mysql:host=' .
                Settings::$HOST_NAME . ';dbname=' . Settings::$DB_NAME .
                ';charset=' . Settings::$CHARSET,
            Settings::$USER,
            Settings::$PASSWORD,
            Settings::$DB_OPTIONS
        );
    }
}
