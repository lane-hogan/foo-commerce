<?php

class Settings {
    public static $env = 'dev';

    public static $environments = [
        'dev' => [
            'db_host' => 'localhost',
            'db_name' => 'foocommerce',
            'db_charset' => 'utf8',
            'db_user' => 'root',
            'db_password' => '',
        ],
        'deployment' => [],
    ];

    public static $DB_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
}