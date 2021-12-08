<?php

class Settings {
    public static $HOST_NAME = '';
    public static $DB_NAME = '';
    public static $CHARSET = '';
    public static $USER = '';
    public static $PASSWORD = '';
    public static $DB_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
}