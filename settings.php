<?php

class Settings
{
    public static $env = 'dev';
    public static $environments = [
        'dev' => [
            'db_host' => 'localhost',
            'db_name' => 'foocommerce',
            'db_charset' => 'utf8',
            'db_user' => 'root',
            'db_password' => '',
        ],
        'deployment' => [
            'db_host' => 'us-cdbr-east-05.cleardb.net',
            'db_name' => 'heroku_438e75cbc9ddd29',
            'db_charset' => 'utf8',
            'db_user' => 'bb33431abb192e',
            'db_password' => '3a403929',
        ],
    ];

    public static $DB_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
}
?>
