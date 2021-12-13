<?php


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

/* INSERTING VALUES INTO THE DATABASE */

//echo DBHelper::insert('INSERT INTO user(fname, lname, email, password, isAdmin) VALUES(?, ?, ?, ?, ?)',
//['Lane', 'Hogan', 'test@test.com', 'password123@#', 1]);

/* RETRIEVING VALUES FROM THE DATABASE */

//$result = DBHelper::query('SELECT * FROM user WHERE isAdmin = 0');
// echo '<pre>';
//print_r($result->fetchAll());
